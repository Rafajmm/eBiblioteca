#!/bin/bash

# Configuración de carpetas
ORIGEN="$HOME/Documentos/eBiblioteca/recursosPDF"
DESTINO="$HOME/Documentos/eBiblioteca/recursosEPUB"

# Crear carpeta de destino si no existe
mkdir -p "$DESTINO"

echo "Iniciando conversión de PDF a EPUB..."
echo "------------------------------------------------"

convertidos=0

for pdf in "$ORIGEN"/*.pdf; do
    [ -e "$pdf" ] || continue

    nombre_base=$(basename "$pdf" .pdf)
    salida="$DESTINO/${nombre_base}.epub"

    echo "Procesando: $nombre_base..."

    # Uso de --base-font-size para asegurar legibilidad en el visor
    ebook-convert "$pdf" "$salida" \
        --enable-heuristics \
        --epub-flatten \
        --flow-size 20 \
        --smarten-punctuation \
        --output-profile generic_eink_hd \
        --base-font-size 12 \
        --level1-toc "//h:h1"

    if [ $? -eq 0 ]; then
        echo "Éxito: $nombre_base.epub"
        ((convertidos++))
    else
        echo "Error al convertir: $nombre_base"
    fi
    echo "------------------------------------------------"
done

echo "Proceso finalizado. Se han convertido $convertidos libros."
echo "Los archivos convertidos están en: $DESTINO"