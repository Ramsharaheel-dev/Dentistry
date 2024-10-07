@extends ('layouts.layout_2')

@section('head')
    <title>Student &#8211; Dian</title>
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

<style>


.preview {
  width: 100%;
}


.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding: 10px 62px 0px 62px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

.modal-content {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  margin: auto;
  padding: 0 0 0 0;
  width: 80%;
  max-width: 1200px;
}



   .image-slide {
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    display: block;
}


.modal-preview {
  width: 100%;
}

[data-theme-version="dark"] .modal-content {
    background: transparent !important;
}

.dots {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  display: none
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.previous,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.previous:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

    </style>

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        <span class="badge badge-primary">Images</span>
                        <span class="badge badge-primary">Videos</span>
                        <span class="badge badge-primary">Past Papers</span>
                        <span class="badge badge-primary">Lecture Notes</span>
                        <span class="badge badge-primary">Wellbeing</span>
                    </div>

                </div>
                <div class="py-4">
                    <p class="step_into_">Disclaimer: All information provided in this section is provided is by fellow
                        students and has not been verified by DIAN club so information should be used at your discretion
                    </p>
                </div>
            </div>

           

     <div class="row">
        <div class="col-md-3">
           <img src="{{ asset('images/student/1.png') }}" onclick="openLightbox();toSlide(1)" class="hover-shadow preview" alt="Toy car on the road." />
        </div>
        <div class="col-md-3">
           <img src="{{ asset('images/student/2.png') }}" onclick="openLightbox();toSlide(2)" class="hover-shadow preview" alt="Toy car exploring offroad." />
        </div>
        <div class="col-md-3">
           <img src="{{ asset('images/student/3.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
        </div>
        <div class="col-md-3">
            <img src="{{ asset('images/student/4.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>

         <div class="py-4"> </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/5.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/6.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/7.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/8.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>

         <div class="py-4"> </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/9.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/10.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/11.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>
         <div class="col-md-3">
            <img src="{{ asset('images/student/12.png') }}" onclick="openLightbox();toSlide(3)" class="hover-shadow preview" alt="Toy car in the city." />
         </div>
      </div>

      <div class="row py-4">
        <div class="col-md-12">
            <button type="button" class="btn1 btn-secondary anek-telugu">New content released every
                month</button>
        </div>
    </div>

      <div id="Lightbox" class="modal">
        <span class="close pointer" onclick="closeLightbox()">&times;</span>
        <div class="modal-content">
          <div class="slide">
              <img src="{{ asset('images/student/1.png') }}" class="image-slide" alt="Toy car on the road." />
          </div>
          <div class="slide">
              <img src="{{ asset('images/student/2.png') }}" class="image-slide" alt="Toy car exploring offroad." />
          </div>
          <div class="slide">
              <img src="{{ asset('images/student/3.png') }}" class="image-slide" alt="Toy car in the city." />
          </div>
          <div class="slide">
            <img src="{{ asset('images/student/4.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/5.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/6.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/7.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/8.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/9.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/10.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/11.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>
        <div class="slide">
            <img src="{{ asset('images/student/12.png') }}" class="image-slide" alt="Toy car in the city." />
        </div>

          <a class="previous" onclick="changeSlide(-1)">&#10094;</a>
          <a class="next" onclick="changeSlide(1)">&#10095;</a>

          <div class="dots">
            <div class="col">
              <img src="{{ asset('images/student/1.png') }}" class="modal-preview hover-shadow" onclick="toSlide(1)" alt="Toy car on the road" />
            </div>
            <div class="col">
              <img src="{{ asset('images/student/2.png') }}" class="modal-preview hover-shadow" onclick="toSlide(2)" alt="Toy car exploring offroad." />
            </div>
            <div class="col">
              <img src="{{ asset('images/student/3.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
            </div>
            <div class="col">
                <img src="{{ asset('images/student/4.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/5.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/6.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/7.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/8.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/9.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/10.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/11.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
              <div class="col">
                <img src="{{ asset('images/student/12.png') }}" class="modal-preview hover-shadow" onclick="toSlide(3)" alt="Toy car in the city." />
              </div>
          </div>
        </div>
      </div>
    </div>

@endsection

<script>
// Initialize here and run showSlide() to give your lightbox a default state.

let slideIndex = 1;
showSlide(slideIndex);

// You are providing the functionality for your clickable content, which is
// your previews, dots, controls and the close button.

function openLightbox() {
  document.getElementById('Lightbox').style.display = 'block';
}

function closeLightbox() {
  document.getElementById('Lightbox').style.display = 'none';
};

// Note that you are assigning new values here to our slidIndex.

function changeSlide(n) {
  showSlide(slideIndex += n);
};

function toSlide(n) {
  showSlide(slideIndex = n);
};

// This is your logic for the light box. It will decide which slide to show
// and which dot is active.

function showSlide(n) {
  const slides = document.getElementsByClassName('slide');
  let modalPreviews = document.getElementsByClassName('modal-preview');

  if (n > slides.length) {
    slideIndex = 1;
  };

  if (n < 1) {
    slideIndex = slides.length;
  };

  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  };

  for (let i = 0; i < modalPreviews.length; i++) {
    modalPreviews[i].className = modalPreviews[i].className.replace(' active', '');
  };

  slides[slideIndex - 1].style.display = 'block';
  modalPreviews[slideIndex - 1].className += ' active';
};
</script>


