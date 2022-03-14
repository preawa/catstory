<footer style="background-color: #f7f2e9;">

    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">

                    {{-- <a class="logo" href="#"><img src="images/logo.png" alt="Logo Image"></a> --}}
                    <p class="copyright font-weight-bold">{{ config('app.name') }} @ 2020.</p>
                    
                    <ul class="icons">
                        <li><a href="#" class="bg-color2"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a href="#" class="bg-color2"><i class="ion-social-twitter-outline"></i></a></li>
                        <li><a href="#" class="bg-color2"><i class="ion-social-instagram-outline"></i></a></li>
                        <li><a href="#" class="bg-color2"><i class="ion-social-vimeo-outline"></i></a></li>
                        <li><a href="#" class="bg-color2"><i class="ion-social-pinterest-outline"></i></a></li>
                    </ul>

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                    <h4 class="title"><b>CATAGORIES</b></h4>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{ route('category.posts',$category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->


        </div><!-- row -->
    </div><!-- container -->
</footer>