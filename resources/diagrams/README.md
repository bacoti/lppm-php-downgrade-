# Diagrams (PlantUML) — cara merender

Folder ini berisi file PlantUML (.puml) untuk Use Case, Class, Sequence, dan Activity diagram.

Cara cepat merender di lokal:

- Dengan VSCode: install extension "PlantUML" oleh jebbs atau plantuml extension lain. buka file `.puml` lalu preview atau export.
- Dengan plantuml.jar (Java diperlukan):

```bash
# jalankan dari folder project root
java -jar plantuml.jar resources/diagrams/*.puml
```

Perintah di atas menghasilkan file PNG di folder yang sama. Untuk SVG tambahkan opsi `-tsvg`.

Alternatif: gunakan PlantUML server online atau integrasi CI untuk menghasilkan artefak.

Catatan: saya hanya membuat file sumber (.puml). Jika Anda mau, saya bisa menghasilkan SVG/PNG lokal jika Anda mengizinkan menjalankan Java di environment ini.
