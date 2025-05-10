# base image untuk Go
FROM golang:1.22-alpine

# Buat folder kerja
WORKDIR /app

# Salin semua file ke container
COPY . .

# Download dependen
RUN go mod download

# Build aplikasi
RUN go build -o main .

# Jalankan
CMD [ "./main" ]
