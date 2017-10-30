Berikut adalah aturan dalam melakukan migrasi database :

1. buat folder sesuai tanggal, beri nama folder dengan format berikut dd-mm-yyyy

2. dump table terlebih dahulu sebelum melakukan perubahan! hal ini penting untuk memudahkan rollback jika terjadi hal yang tidak diinginkan sesudah table diubah

3. setelah melakukan perubahan/penambahan table, dump table tersebut dengan options sbb :: INSERT IGNORE, DROP, CREATE agar tidak terjadi konflik antar table baru dengan table lama

4. beri nama file sql tersebut dengan nama sbb ::
   - untuk file sql sebelum perubahan : nama-orang-yang-merubah_nama-tabel_before
   - untuk file sql sebelum perubahan : nama-orang-yang-merubah_nama-tabel_after

5. jangan lupa untuk menulis perubahan/penambahan table di log.txt yang ada pada tiap folder. dan harap untuk memberi tanda antara satu user dengan user lainnya.
Contoh : 

====================IBO=====================
change log :
- bla bla
- bla bla bla
====================IBO=====================

