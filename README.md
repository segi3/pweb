## Tugas Python MySQL

Website hanya memiliki API endpoint, tidak memiliki interface.

Tabel dan dummy data dapat di create dari file `db-tables.php`

### 1 Mengirim gambar

Berfungsi untuk menerima data image, lalu menyimpan image pada local dan mencatat operasi yang berhasil di database. Membutuhkan akun yang didaftarkan di tabel `users`.

url: `sendFace.php`

API menerima form-data:
```
image: (base64)
idUser: (string)
password: (string)
```
```
idUser dummy: 05111840000094
passwod dummy: 12345678
```

Contoh run:

```
image: data:image/png;base64,iVBSDDScfeq.....
idUser: 05111840000094
password: 12345678
```

Response 200
```json
{
    "status": 200,
    "success": true,
    "message": "Berhasil menyimpan",
    "image": "X__12_20201217053306.png",
    "total": 12
}
```

Response 401
```json
{
    "status": 401,
    "success": false,
    "message": "Gagal login"
}
```

Response 500
```json
{
    "status": 500,
    "success": false,
    "image": "X__17_20201217053306.png",
    "message": "Gagal disimpan"
}
```

### 2 Mendapatkan Log Insert

Berfungsi untuk mendapatkan log dari user.

url: `getLogs.php`

API menerima form-data:
```
idUser: (string)
password: (string)
```
```
idUser dummy: 05111840000094
passwod dummy: 12345678
```

Contoh run:

```
idUser: 05111840000094
password: 12345678
```

Response 200
```json
{
    "status": 200,
    "success": true,
    "0": {
        "id": "4",
        "nrp": "05111840000094",
        "image_path": "X__1_20201217051222.png",
        "timestamp": "2020-12-17 11:12:22"
    },
    "1": {
        "id": "5",
        "nrp": "05111840000094",
        "image_path": "X__2_20201217052305.png",
        "timestamp": "2020-12-17 11:23:05"
    },
    "2": {
        "id": "6",
        "nrp": "05111840000094",
        "image_path": "X__3_20201217052306.png",
        "timestamp": "2020-12-17 11:23:06"
    },
    "3": {
        "id": "7",
        "nrp": "05111840000094",
        "image_path": "X__4_20201217052307.png",
        "timestamp": "2020-12-17 11:23:07"
    },
    "4": {
        "id": "8",
        "nrp": "05111840000094",
        "image_path": "X__5_20201217052307.png",
        "timestamp": "2020-12-17 11:23:07"
    },
    "5": {
        "id": "9",
        "nrp": "05111840000094",
        "image_path": "X__6_20201217052308.png",
        "timestamp": "2020-12-17 11:23:08"
    },
    "6": {
        "id": "10",
        "nrp": "05111840000094",
        "image_path": "X__7_20201217052308.png",
        "timestamp": "2020-12-17 11:23:08"
    },
    "7": {
        "id": "11",
        "nrp": "05111840000094",
        "image_path": "X__8_20201217052309.png",
        "timestamp": "2020-12-17 11:23:09"
    },
    "8": {
        "id": "12",
        "nrp": "05111840000094",
        "image_path": "X__9_20201217052309.png",
        "timestamp": "2020-12-17 11:23:09"
    },
    "9": {
        "id": "13",
        "nrp": "05111840000094",
        "image_path": "X__10_20201217052310.png",
        "timestamp": "2020-12-17 11:23:10"
    },
    "10": {
        "id": "14",
        "nrp": "05111840000094",
        "image_path": "X__11_20201217052956.png",
        "timestamp": "2020-12-17 11:29:56"
    },
    "11": {
        "id": "15",
        "nrp": "05111840000094",
        "image_path": "X__12_20201217053306.png",
        "timestamp": "2020-12-17 11:33:06"
    }
}
```