<footer class="pt-3 pb-3 border-top text-white text-center" style="background-color: #003e5f">
    {{-- <div class="row col-lg-12 pl-5 pr-5">


      <div class="col-lg-3 col-md-12">
              <hr class="d-none">
       <span class="d-block">Rectorate Building</span>
       <div style="line-height: 17px; font-size: 9pt;">Perintis Kemerdekaan Street KM.10, Tamalanrea Indah, Tamalanrea, Makassar City, South Sulawesi 90245<br>
       Telp: +62411-586200, +62411-584200<br>
       Fax: +62411-585188 <br>
       foreignstudent@unhas.ac.id</div>
      </div>
    </div> --}}
    {{-- <hr style="border-color: #0f5175"> --}}
      {{-- <div class="pb-3 pl-3 pr-3">
       <span class="socicon float-right"><a href="#"><i class="socicon-instagram instagram "></i></a></span>
       <span class="socicon float-right"><a href="#"><i class="socicon-twitter twitter "></i></a></span>
       <span class="socicon float-right"><a href="#"><i class="socicon-facebook facebook "></i></a></span>
       <span class="float-right">Get in touch</span>
       <span class="toTop" id="myBtn"><a href="#" class="btn btn-md btn-outline-light"><i class="fas fa-arrow-up"></i></a></span> --}}

    <span>© {{date('Y')}}. {{ \App\About::find(1)->copyright ?? 'GundalaCMS' }}</span></div>
  </footer>
