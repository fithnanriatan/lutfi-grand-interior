   <footer class="footer-section">
       <div class="container relative">
           <div class="sofa-img">
               <img src="{{ asset('untree/images/sofa.png') }}" alt="Image" class="img-fluid">
           </div>

           <div class="row g-5 mb-5">
               <div class="col-lg-4">
                   <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Lutfi Grand
                           Interior<span>.</span></a></div>
                   <p class="mb-4">Menciptakan ruang yang tidak hanya indah dipandang, tetapi juga nyaman
                       ditinggali. Solusi interior terpercaya Anda.</p>

                   <ul class="list-unstyled custom-social">
                       <li><a href="https://www.facebook.com/lutfi.oi"><span class="fa fa-brands fa-facebook-f"></span></a> - Lutfi Oi</li>
                   </ul>
               </div>

               <div class="col-lg-8">
                   <div class="row links-wrap">
                       <div class="col-6 col-sm-6 col-md-3">
                           <ul class="list-unstyled">
                               <li><a href="#home">Home</a></li>
                               <li><a href="#services">Layanan</a></li>
                               <li><a href="#portfolio">Portfolio</a></li>
                               <li><a href="#contact">Kontak</a></li>
                               <li><a href="{{ route('login') }}">Login Admin</a></li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>

           <div class="border-top copyright">
               <div class="row pt-4">
                   <div class="col-lg-6">
                       <p class="mb-2 text-center text-lg-start">Copyright &copy;
                           <script>
                               document.write(new Date().getFullYear());
                           </script>. All Rights Reserved to Lutfi Grand Interior. &mdash; Designed with love by <a
                               href="https://untree.co">Putri Team</a>
                       </p>
                   </div>
               </div>
           </div>
       </div>
   </footer>
   <script src="{{ asset('untree/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('untree/js/tiny-slider.js') }}"></script>
   <script src="{{ asset('untree/js/custom.js') }}"></script>
   <script>
       function kirimKeWhatsapp() {
           // 1. Ambil Data Input
           var nama = document.getElementById('nama').value;
           var telepon = document.getElementById('telepon').value;
           var alamat = document.getElementById('alamat').value;
           var layanan = document.getElementById('layanan').value;
           var catatan = document.getElementById('catatan').value;
           var kelurahan = "";
           var kecamatan = "";
           var kota = "";


           // 2. Validasi Sederhana (Opsional - agar data tidak kosong)
           if (nama === "" || telepon === "" || layanan === "") {
               alert("Mohon lengkapi Nama, Nomor Telepon, dan Layanan.");
               return;
           }

           // 3. Format Pesan WhatsApp (Gunakan \n untuk baris baru)
           var pesan = "*Halo Admin, saya ingin melakukan pemesanan baru.*%0A%0A" +
               "*DATA PELANGGAN* %0A" +
               "Nama: " + nama + "%0A" +
               "No. HP: " + telepon + "%0A" +
               "Alamat: " + alamat + "%0A%0A" +
               "*DATA PESANAN* %0A" +
               "Layanan: " + layanan + "%0A" +
               "Catatan: " + catatan;

           // 4. Kirim ke API WhatsApp
           // GANTI NOMOR INI DENGAN NOMOR TUJUAN (Gunakan kode negara 62, tanpa +)
           var nomorTujuan = "6283157100105";

           var url = "https://wa.me/" + nomorTujuan + "?text=" + pesan;

           // 5. Buka tab baru
           window.open(url, '_blank');
       }
   </script>
   </body>

   </html>
