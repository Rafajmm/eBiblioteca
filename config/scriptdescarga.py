import requests
from bs4 import BeautifulSoup
import os
import time

lista_titulos = [
    "Don Quijote de la Mancha", "Fortunata y Jacinta", "Marianela", "Los pazos de Ulloa",
    "La Regenta", "Rimas", "Cantares gallegos", "Don Juan Tenorio", "La Celestina",
    "Fuenteovejuna", "La vida es sueño", "El burlador de Sevilla", "Vuelva usted mañana",
    "Martín Fierro", "María", "Cuentos de amor de locura y de muerte", "Cuentos de la selva",
    "Azul...", "Versos sencillos", "Aves sin nido", "Facundo", "Ariel", "Nocturno",
    "Los heraldos negros", "Viaje maravilloso del señor Nic-Nac al planeta Marte",
    "Primero sueño", "Nuestra América", "Prosas profanas", "La vorágine", "Tradiciones peruanas"
]

def normalizar(texto):
    """Limpia el texto para comparar mejor."""
    return texto.lower().strip()

def descargar_biblioteca_final(titulos):
    base_url = "https://www.elejandria.com"
    carpeta = "libros_elejandria"
    if not os.path.exists(carpeta): os.makedirs(carpeta)

    headers = {
        "User-Agent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
    }

    for titulo_original in titulos:
        try:
            titulo = normalizar(titulo_original)
            # Elejandría a veces ignora artículos iniciales en el índice. 
            # Si empieza por "La", "El", probamos con esa letra, pero si falla podríamos probar la siguiente palabra.
            letra = titulo[0]
            url_indice = f"{base_url}/libros/{letra}"
            
            print(f"\n📖 Procesando: '{titulo_original}' (Índice: {letra.upper()})")
            res_indice = requests.get(url_indice, headers=headers)
            soup_indice = BeautifulSoup(res_indice.text, 'html.parser')

            # 1. Encontrar el libro (Busqueda flexible)
            enlace_libro = None
            palabras_clave = titulo.split()[:2] # Tomamos las dos primeras palabras para buscar
            
            for a in soup_indice.find_all('a', href=True):
                texto_link = normalizar(a.text)
                # Si las palabras clave están en el título del catálogo
                if all(palabra in texto_link for palabra in palabras_clave):
                    enlace_libro = a['href']
                    break
            
            if not enlace_libro:
                print(f"❌ No se encontró nada similar a '{titulo_original}' en la letra {letra.upper()}")
                continue

            # 2. Ir a la página del libro y buscar el botón "Descargar en PDF"
            full_url_libro = base_url + enlace_libro if not enlace_libro.startswith('http') else enlace_libro
            print(f"🔗 Libro: {full_url_libro}")
            
            res_libro = requests.get(full_url_libro, headers=headers)
            soup_libro = BeautifulSoup(res_libro.text, 'html.parser')
            
            # --- Análisis de Portada (Lo que pedías) ---
            img_tag = soup_libro.find('img', class_='img-book-cover')
            if img_tag:
                print(f"🖼️ Portada: {base_url + img_tag['src'] if img_tag['src'].startswith('/') else img_tag['src']}")

            # Buscamos el enlace que tú identificaste (el que tiene 'descargar' y contiene 'PDF')
            btn_intermedio = soup_libro.find('a', href=True, class_='download-link')
            # Si hay varios, intentamos asegurar que sea el de PDF
            if not btn_intermedio or 'pdf' not in btn_intermedio.text.lower():
                btn_intermedio = soup_libro.select_one('a[href*="/descargar/"][href*="pdf"]')

            if btn_intermedio:
                url_pagina_descarga = base_url + btn_intermedio['href'] if not btn_intermedio['href'].startswith('http') else btn_intermedio['href']
                print(f"📄 Página de descarga: {url_pagina_descarga}")

                # 3. Ir a la página final de descarga y buscar el enlace "link_descarga_libro"
                res_final = requests.get(url_pagina_descarga, headers=headers)
                soup_final = BeautifulSoup(res_final.text, 'html.parser')
                
                btn_final = soup_final.select_one('a[href*="/link_descarga_libro/"]')
                
                if btn_final:
                    download_url = base_url + btn_final['href'] if not btn_final['href'].startswith('http') else btn_final['href']
                    print(f"📥 Descargando archivo final...")
                    
                    archivo = requests.get(download_url, headers=headers)
                    nombre_fichero = f"{titulo_original.replace(' ', '_')}.pdf"
                    
                    with open(os.path.join(carpeta, nombre_fichero), 'wb') as f:
                        f.write(archivo.content)
                    print(f"✅ ¡Descargado!: {nombre_fichero}")
                else:
                    print("⚠️ No se encontró el botón de descarga final en la página intermedia.")
            else:
                print("⚠️ No se encontró el botón 'Descargar en PDF'.")

            time.sleep(4) # Importante para no ser bloqueado

        except Exception as e:
            print(f"🚨 Error inesperado con {titulo_original}: {e}")

if __name__ == "__main__":
    descargar_biblioteca_final(lista_titulos)