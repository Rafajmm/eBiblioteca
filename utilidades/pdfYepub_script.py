import requests
from bs4 import BeautifulSoup
import os
import time
import re
import unicodedata
from pathlib import Path

lista_titulos = [
    "Frankenstein", "Orgullo y prejuicio", "Cumbres borrascosas", "La llamada de lo salvaje",
    "La metamorfosis", "Niebla", "El corazón de las tinieblas", "La casa de la alegría",
    "Vindicación de los derechos de la mujer", "Sobre la libertad", "Desobediencia civil",
    "El alma del hombre bajo el socialismo", "Defensa de las mujeres", "Una habitación propia",
    "Hojas de hierba", "Poemas de Emily Dickinson", "Campos de Castilla", "El dulce daño",
    "Los cálices vacíos", "Casa de muñecas", "La importancia de llamarse Ernesto",
    "El jardín de los cerezos", "Bodas de sangre", "Yerma",
    "Alicia en el país de las maravillas", "El maravilloso mago de Oz", "El libro de la selva",
    "Heidi", "Las aventuras de Pinocho"
]


def normalizar(texto):
    """Normaliza texto para comparar búsquedas."""
    texto = texto.lower().strip()
    texto = unicodedata.normalize("NFKD", texto)
    texto = "".join(c for c in texto if not unicodedata.combining(c))
    return texto


def obtener_raiz_proyecto():
    """
    Este script está pensado para ejecutarse desde utilidades/scriptdescarga.py.

    Estructura esperada:
    eBiblioteca/
    ├── public/
    │   └── obras/
    │       ├── recursosPDF/
    │       └── recursosEPUB/
    └── utilidades/
        └── scriptdescarga.py
    """
    ruta_script = Path(__file__).resolve()
    return ruta_script.parent.parent


def nombre_archivo_seguro(titulo, extension):
    """
    Genera nombres compatibles con las rutas usadas en la BD:
    Titulo_con_espacios_sustituidos.ext
    """
    nombre = titulo.strip().replace(" ", "_")
    nombre = re.sub(r'[\\/*?:"<>|]', "", nombre)
    return f"{nombre}.{extension.lower()}"


def construir_rutas_destino():
    raiz = obtener_raiz_proyecto()

    carpeta_pdf = raiz / "public" / "obras" / "recursosPDF"
    carpeta_epub = raiz / "public" / "obras" / "recursosEPUB"

    carpeta_pdf.mkdir(parents=True, exist_ok=True)
    carpeta_epub.mkdir(parents=True, exist_ok=True)

    return {
        "pdf": carpeta_pdf,
        "epub": carpeta_epub
    }


def descargar_formato(soup_libro, base_url, headers, carpetas_destino, titulo_original, formato):
    formato = formato.lower()

    btn_intermedio = None

    # 1. Buscar enlaces tipo botón de descarga
    for enlace in soup_libro.find_all("a", href=True, class_="download-link"):
        texto = normalizar(enlace.get_text(" "))
        href = enlace["href"].lower()

        if formato in texto or formato in href:
            btn_intermedio = enlace
            break

    # 2. Buscar enlaces /descargar/ que contengan el formato
    if not btn_intermedio:
        btn_intermedio = soup_libro.select_one(
            f'a[href*="/descargar/"][href*="{formato}"]'
        )

    # 3. Búsqueda más flexible
    if not btn_intermedio:
        for enlace in soup_libro.find_all("a", href=True):
            texto = normalizar(enlace.get_text(" "))
            href = enlace["href"].lower()

            if "descargar" in texto and formato in texto:
                btn_intermedio = enlace
                break

            if "/descargar/" in href and formato in href:
                btn_intermedio = enlace
                break

    if not btn_intermedio:
        print(f"⚠️ No se encontró botón de descarga en {formato.upper()}.")
        return False

    url_pagina_descarga = (
        base_url + btn_intermedio["href"]
        if not btn_intermedio["href"].startswith("http")
        else btn_intermedio["href"]
    )

    print(f"📄 Página de descarga {formato.upper()}: {url_pagina_descarga}")

    res_final = requests.get(url_pagina_descarga, headers=headers, timeout=30)
    res_final.raise_for_status()

    soup_final = BeautifulSoup(res_final.text, "html.parser")

    btn_final = soup_final.select_one('a[href*="/link_descarga_libro/"]')

    if not btn_final:
        print(f"⚠️ No se encontró el enlace final para {formato.upper()}.")
        return False

    download_url = (
        base_url + btn_final["href"]
        if not btn_final["href"].startswith("http")
        else btn_final["href"]
    )

    print(f"📥 Descargando {formato.upper()}...")

    archivo = requests.get(download_url, headers=headers, timeout=60)
    archivo.raise_for_status()

    nombre_fichero = nombre_archivo_seguro(titulo_original, formato)
    ruta_destino = carpetas_destino[formato] / nombre_fichero

    with open(ruta_destino, "wb") as f:
        f.write(archivo.content)

    print(f"✅ Descargado {formato.upper()}: {ruta_destino}")
    return True


def descargar_biblioteca_final(titulos):
    base_url = "https://www.elejandria.com"
    carpetas_destino = construir_rutas_destino()

    print("📁 Carpeta PDF:", carpetas_destino["pdf"])
    print("📁 Carpeta EPUB:", carpetas_destino["epub"])

    headers = {
        "User-Agent": (
            "Mozilla/5.0 (X11; Linux x86_64) "
            "AppleWebKit/537.36 (KHTML, like Gecko) "
            "Chrome/120.0.0.0 Safari/537.36"
        )
    }

    for titulo_original in titulos:
        try:
            titulo = normalizar(titulo_original)
            letra = titulo[0]
            url_indice = f"{base_url}/libros/{letra}"

            print(f"\n📖 Procesando: '{titulo_original}'")
            print(f"🔎 Índice: {url_indice}")

            res_indice = requests.get(url_indice, headers=headers, timeout=30)
            res_indice.raise_for_status()

            soup_indice = BeautifulSoup(res_indice.text, "html.parser")

            enlace_libro = None
            palabras_clave = titulo.split()[:2]

            for a in soup_indice.find_all("a", href=True):
                texto_link = normalizar(a.get_text(" "))

                if all(palabra in texto_link for palabra in palabras_clave):
                    enlace_libro = a["href"]
                    break

            if not enlace_libro:
                print(f"❌ No se encontró nada similar a '{titulo_original}' en la letra {letra.upper()}")
                continue

            full_url_libro = (
                base_url + enlace_libro
                if not enlace_libro.startswith("http")
                else enlace_libro
            )

            print(f"🔗 Libro: {full_url_libro}")

            res_libro = requests.get(full_url_libro, headers=headers, timeout=30)
            res_libro.raise_for_status()

            soup_libro = BeautifulSoup(res_libro.text, "html.parser")

            img_tag = soup_libro.find("img", class_="img-book-cover")
            if img_tag and img_tag.get("src"):
                portada = (
                    base_url + img_tag["src"]
                    if img_tag["src"].startswith("/")
                    else img_tag["src"]
                )
                print(f"🖼️ Portada detectada: {portada}")

            descargado_pdf = descargar_formato(
                soup_libro=soup_libro,
                base_url=base_url,
                headers=headers,
                carpetas_destino=carpetas_destino,
                titulo_original=titulo_original,
                formato="pdf"
            )

            time.sleep(2)

            descargado_epub = descargar_formato(
                soup_libro=soup_libro,
                base_url=base_url,
                headers=headers,
                carpetas_destino=carpetas_destino,
                titulo_original=titulo_original,
                formato="epub"
            )

            if not descargado_pdf and not descargado_epub:
                print("⚠️ No se descargó ningún formato para esta obra.")

            time.sleep(4)

        except requests.exceptions.RequestException as e:
            print(f"🚨 Error de red con '{titulo_original}': {e}")

        except Exception as e:
            print(f"🚨 Error inesperado con '{titulo_original}': {e}")


if __name__ == "__main__":
    descargar_biblioteca_final(lista_titulos)