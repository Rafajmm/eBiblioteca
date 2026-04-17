#!/bin/bash
set -u

# Configuración de carpetas
ORIGEN="$HOME/Documentos/eBiblioteca/public/obras/recursosPDF"
DESTINO="$HOME/Documentos/eBiblioteca/public/obras/recursosEPUB"
LOGDIR="$DESTINO/logs"

mkdir -p "$DESTINO" "$LOGDIR"

echo "Iniciando conversión de PDF a EPUB..."
echo "Origen : $ORIGEN"
echo "Destino: $DESTINO"
echo "------------------------------------------------"

convertidos=0
errores=0

shopt -s nullglob
for pdf in "$ORIGEN"/*.pdf; do
    nombre_base="$(basename "$pdf" .pdf)"
    salida="$DESTINO/${nombre_base}.epub"
    log="$LOGDIR/${nombre_base}.log"

    echo "Procesando: $nombre_base..."

    if ebook-convert "$pdf" "$salida" \
        --pdf-engine calibre \
        --enable-heuristics \
        --unwrap-factor 0.45 \
        --smarten-punctuation \
        --output-profile generic_eink_hd \
        --chapter "//h:h1|//h:h2" \
        --chapter-mark pagebreak \
        --page-breaks-before "//h:h1|//h:h2" \
        --level1-toc "//h:h1" \
        --level2-toc "//h:h2" \
        --toc-threshold 0 \
        --use-auto-toc \
        --max-toc-links 0 \
        --pretty-print \
        --verbose \
        >"$log" 2>&1
    then
        echo "Éxito: ${nombre_base}.epub"
        ((convertidos++))
    else
        echo "Error al convertir: $nombre_base"
        echo "Revisa el log: $log"
        rm -f "$salida"
        ((errores++))
    fi

    echo "------------------------------------------------"
done

echo "Proceso finalizado."
echo "Convertidos: $convertidos"
echo "Errores    : $errores"
echo "EPUBs en   : $DESTINO"
echo "Logs en    : $LOGDIR"