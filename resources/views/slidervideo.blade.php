<div class="review-slider">
    <div class="tittle-head">
        <h3 class="tittle">More <span class="new"> Videos</span> Below</h3>
        <div class="clearfix"></div>
    </div>


    <ul id="flexiselDemo1">

        @foreach($videos as $vides)
        <li>
            <a href="{!!'/mypost?video='. $vides->id!!}"><img src="{!! $vides->imageurl!!}" alt=""/></a>
            <div class="slide-title"><h4>{{$vides->title}} </h4></div>
            <div class="date-city">

                <div class="buy-tickets">
                    <a href="{!!'/mypost?video='. $vides->id!!}">Play Now</a>
                </div>
            </div>
        </li>
        {{--{{dd($vides->title)}}--}}
        @endforeach
    </ul>
    <script type="text/javascript">
        $(window).load(function () {

            $("#flexiselDemo1").flexisel({
                visibleItems: 5,
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
    <script type="text/javascript" src="js/jquery.flexisel.js"></script>
</div>
