
@extends('website.layout.main')
@section('main-content')

    <!-- MAIN SECTION START -->
    <main class="container-fluid px-0">
        <!-- NEWS DETAILS SECTION START -->
        <section class="news_details_section px-3 px-md-0">
            <div class="container mb-n3">
                <div class="row mx-md-0">
                    <span class="text-muted font-italic">22 May 2020</span>
                    <h1 class="heading_ellipsis text-uppercase mb-3 mt-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h1>

                    <img src="{{url('public/website/images/stock-images/banner-3.jpg')}}" class="img-fluid rounded mb-5">

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>

                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                    
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                </div>
            </div>
        </section>
        <!-- NEWS DETAILS SECTION END -->


        <!-- NEWS SECTION START -->
        <section class="news_section" style="background-color: var(--lightColor);">
            <div class="container mb-n4">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <img src="{{url('public/website/images/stock-images/banner-3.jpg')}}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="heading_ellipsis text-uppercase mb-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>
                                <span class="text-muted small font-italic">22 May 2020</span>
                                <p class="block_ellipsis mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>
                                <a href="{{url('news')}}" class="text-decoration-none">Read More <i class="fas fa-long-arrow-alt-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <img src="{{url('public/website/images/stock-images/banner-4.jpg')}}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="heading_ellipsis text-uppercase mb-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>
                                <span class="text-muted small font-italic">22 May 2020</span>
                                <p class="block_ellipsis mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>
                                <a href="{{url('news')}}" class="text-decoration-none">Read More <i class="fas fa-long-arrow-alt-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <img src="{{url('public/website/images/stock-images/banner-5.jpg')}}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="heading_ellipsis text-uppercase mb-3" style="font-weight: bold;">SUDS-2-U raises $3.5 million for its on-demand car washing service and biz platform</h5>
                                <span class="text-muted small font-italic">22 May 2020</span>
                                <p class="block_ellipsis mt-2">Another startup wants to make on-demand car washing work, where others have failed. SUDS-2-U, a Boca Raton-based service for on-demand washes, has raised $3.5 million in seed funding to continue to grow its business, which involves a mobile app consumers use to connect with SUDS-2-U’s network of around 1,000 licensed and insured car washing professionals.</p>
                                <a href="{{url('news')}}" class="text-decoration-none">Read More <i class="fas fa-long-arrow-alt-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- NEWS SECTION END -->
    </main>
    <!-- MAIN SECTION END -->

@endsection
    