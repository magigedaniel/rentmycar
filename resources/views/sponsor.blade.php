<div class="review-slider" style="position: relative;">
    <div class="tittle-head center">
        <h3 class="tittle" style="text-align: center; margin-left: 42%;">Our Partners</h3>
        <div class="clearfix"></div>
    </div>

    <ul id="flexiselDemo1" >
        <li>
            <a href=""><img src="{{asset('images/p1.png')}}" alt="" height="120"/></a>
            <div class="slide-title">
                {{--<h4>{{$vides->title}} </h4>--}}
                            </div>
                            <div class="date-city">
                            </div>
            </li        >
        <li>
    <a href=""><img src="{{asset('images/p2.jpg')}}" alt=""height="120"/></a>
            <div class="slide-title">
    {{--<h4>{{$vides->title}} </h4>--}}
            </div>
            <div class="date-city">
            </div>
        </li>
       
    <li>
    <a href=""><img src="{{asset('images/p4.png')}}" alt=""height="120"/></a>
            <div class="slide-title">
                {{--<h4>{{$vides->title}} </h4>--}}
            </div>
            <div class="date-city">
            </div>
        </li>
            <li>
    <a href=""><img src="{{asset('images/p5.png')}}" alt=""height="120"/></a>
            <div class="slide-title">
                {{--<h4>{{$vides->title}} </h4>--}}
            </div>
            <div class="date-city">
            </div>
        </li>
            <li>
    <a href=""><img src="{{asset('images/p6.jpg')}}" alt=""height="120"/></a>
            <div class="slide-title">
                {{--<h4>{{$vides->title}} </h4>--}}
            </div>
            <div class="date-city">
            </div>
        </li>
            <li>
    <a href=""><img src="{{asset('images/p7.png')}}" alt=""height="120"/></a>
            <div class="slide-title">
                {{--<h4>{{$vides->title}} </h4>--}}
            </div>
            <div class="date-city">
            </div>
        </li>
            <li>
    <a href=""><img src="{{asset('images/p8.png')}}" alt=""height="120"/></a>
            <div class="slide-title">
                {{--<h4>{{$vides->title}} </h4>--}}
            </div>
            <div class="date-city">
            </div>
        </li>

    </ul>
                <script type="text/javascript">
                    $(window).load(function () {

                        $("#flexiselDemo1").flexisel({
                            visibleItems: 8,
                            animationSpeed: 1000,
                            autoPlay: true,
                            autoPlaySpeed: 3000,
                            pauseOnHover: true,
                            enableResponsiveBreakpoints: true,
                            responsiveBreakpoints: {
                                portrait: {
                                    changePoint: 480,
                                    visibleItems: 2
                                },
                                landscape: {
                                    changePoint: 640,
                                    visibleItems: 3
                                },
                                tablet: {
                                    changePoint: 800,
                                    visibleItems: 4
                                }
                            }
                        });
                    });
                    </script>
                    <script src="{{asset('js/jquery.flexisel.js')}}"></script>
                </div>
