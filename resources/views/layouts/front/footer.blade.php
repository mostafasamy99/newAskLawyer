<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <h5 class="footer-title">تواصل معنا</h5>
                    <p><a href="tel:{{$data['settings'] ? $data['settings']['mobile'] : '01007347171'}}">{{$data['settings'] ? $data['settings']['mobile'] : '01007347171'}} <i class="fas fa-phone-alt"></i></a></p>
                    <p><a href="mailto:{{$data['settings'] ? $data['settings']['email'] : 'info@AskLawyer.com'}}">{{$data['settings'] ? $data['settings']['email'] : 'info@AskLawyer.com'}} <i class="fas fa-envelope"></i></a></p>
                    <p><a href="https://www.google.com/maps/place/39+Street,+Asmaa+Fahmy,+Giza">{{$data['settings'] ? $data['settings']['location'] : '39 شارع أسماء فهمى، أرض الجولف خلف الرقابة الادارية'}} <i class="fas fa-map-marker-alt"></i></a></p>
                </div>
                <div class="col-md-3">
                    <h5 class="footer-title">الموقع</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">عن الشركة</a></li>
                        <li><a href="#">الخدمات</a></li>
                        <li><a href="#">محاميين</a></li>
                        <li><a href="#">الاخبار</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-center footer-logo">
                    <img src="{{asset('front/assets/img/logo-footer.png')}}" alt="Ask Lawyer Logo">
                    <p><a href="#">احصل على مساعدة قانونية عبر الانترنت</a></p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-copy">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <p>All Rights Reserved to Ask Lawyer | Made and Powered by evyX</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="social-icons">
                            <a href="{{$data['settings'] ? $data['settings']['facebook'] : '#'}}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{$data['settings'] ? $data['settings']['insta'] : '#'}}"><i class="fab fa-instagram"></i></a>
                            <a href="{{$data['settings'] ? $data['settings']['whats'] : '#'}}"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>

<div class="fixed-links">
    <a href="tel:{{$data['settings'] ? $data['settings']['mobile'] : '01007347171'}}" title="Call Us"><i class="fas fa-phone-volume"></i></a>
    <a href="sms:+{{$data['settings'] ? $data['settings']['mobile'] : '01007347171'}}" title="Chat with Us"><img src="{{asset('front/assets/img/comment-alt-dots.svg')}}" class="img-fluid" alt="comment"></a>
    <a href="mailto:{{$data['settings'] ? $data['settings']['email'] : 'info@AskLawyer.com'}}" title="Ask a Question"><img src="{{asset('front/assets/img/chats.svg')}}" alt="chats" class="img-fluid"></a>
</div>

<div class="modal fade" id="errorModalTerms" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center" data-bs-dismiss="modal">
                <i class="fa fa-window-close" style="color: rgb(156, 14, 43);"></i>
                <p>يجب قبول شروط الخدمة</p>
            </div>
        </div>
    </div>
</div>
