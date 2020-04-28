<style>
    .col-12.col-lg-7.m-auto.p-0 {
        margin-top: 0px !important;
    }

    .art_desc p {
        padding: 0px;
        margin: 0px;
    }


</style>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row m-0 p-0">
                    <div class="col-12 col-lg-7 m-auto p-0">
                        <div class="image_overview">
                            <!-- <img width="100%" class="img-thumbnail" src="assets/images/collcetion/gallery-2-500x500 - Copy.jpg" alt="image"> -->

                            <img id="expandedImg" src="/images/feature/{{$art->image}}" style="width:100%">
                        </div>
                        <div class="all_image">
                            <div class="row m-0 p-0">
                                @if($art->relatedImages->count() > 0)
                                    <div class="column">
                                        <img class="mr-2" src="/images/thumb/{{$art->image}}"
                                             alt="Nature"
                                             data-img="/images/feature/{{$art->image}}"
                                             style="max-width: 100px;cursor: pointer" onclick="myFunction(this);">
                                    </div>
                                @endif

                                @foreach($art->relatedImages as $relatedImage)
                                    <div class="column">
                                        <img class="mr-2" src="/images/thumb/{{$relatedImage->name}}"
                                             alt="Nature"
                                             data-img="/images/feature/{{$relatedImage->name}}"
                                             style="max-width: 100px;cursor: pointer" onclick="myFunction(this);">
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 ml-auto">
                        <div class="art_desc">
                            <h3 class="art_name" style="font-size: 60px">{{$art->name}}</h3>
                            <h3 style="font-size: 16px">{{$art->year}} | {{$art->mold_name}}</h3>
                            <p class="show-text-as-white-space" style="font-size: 16px">
                                {!! $art->description !!}
                            </p>
                            <h3 style="font-size: 16px">{{$art->size1}} | {{$art->size2}}</h3>

                            @auth()
                                <br>
                                <p class="show-text-as-white-space hidden-info-section" style="font-size: 16px">
                                    {!! $art->hidden_info !!}
                                </p>

                            @endauth
                        </div>
                        <div class="art_overview_btn">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">


                                    @if(!empty($art->dropbox_url))
                                        @php
                                            $image = str_replace('?dl=0','?dl=1',$art->dropbox_url);
                                        @endphp
                                        <a href="{{$image}}"
                                           class="btn btn-outline-light rounded-0 btn-block mt-3">
                                            DOWNLOAD HIGH RESOLUTION IMAGE
                                        </a>
                                    @else
                                        <a href="{{route('art.image.download',$art->id)}}"
                                           class="btn btn-outline-light rounded-0 btn-block mt-3">
                                            DOWNLOAD HIGH RESOLUTION IMAGE
                                        </a>
                                    @endif
                                </div>


                                <div class="col-md-12 col-lg-12">
                                    <a href="{{route('art.pdf.download',$art->id)}} "
                                       class="btn btn-outline-light rounded-0 btn-block mt-3">
                                        DOWNLOAD PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function myFunction(imgs) {
        var expandImg = document.getElementById("expandedImg");
        var imgText = document.getElementById("imgtext");
        expandImg.src = imgs.dataset.img;
        imgText.innerHTML = imgs.dataset.img;
        expandImg.parentElement.style.display = "block";
    }


    var tables = document.getElementsByTagName('p');
    // var tables = document.querySelector('.hidden-info-section');
    for (var i = 0; i < tables.length; i++) {
        var s = tables[i].innerHTML;
        s = s.replace('available', '<span style="color:green">available</span>');
        tables[i].innerHTML = s;

        var s = tables[i].innerHTML;
        s = s.replace('Available', '<span style="color:green">Available</span>');
        tables[i].innerHTML = s;
    }
</script>
