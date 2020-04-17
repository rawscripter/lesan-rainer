<style>
    .modal-open .modal {
        background-color: transparent !important;
    }

    button.close {
        position: absolute;
        top: 0;
        right: 10px;
    }

    .modal-header {
        padding: 0;
        margin: 0;
    }

    .modal-dialog {
        max-width: 1100px;
        margin: 1.75rem auto;
    }
</style>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
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
                            <img id="expandedImg" src="/images/feature/{{$installation->image_1}}" style="width:100%">
                        </div>
                        <div class="all_image">
                            <div class="row m-0 p-0">


                                <div class="column">
                                    <img class="mr-2" src="/images/thumb/{{$installation->image_1}}"
                                         alt="Nature"
                                         data-img="/images/feature/{{$installation->image_1}}"
                                         style="max-width: 100px;cursor: pointer" onclick="myFunction(this);">
                                </div>


                                <div class="column">
                                    <img class="mr-2" src="/images/thumb/{{$installation->image_2}}"
                                         alt="Nature"
                                         data-img="/images/feature/{{$installation->image_2}}"
                                         style="max-width: 100px;cursor: pointer" onclick="myFunction(this);">
                                </div>


                                <div class="column">
                                    <img class="mr-2" src="/images/thumb/{{$installation->image_3}}"
                                         alt="Nature"
                                         data-img="/images/feature/{{$installation->image_3}}"
                                         style="max-width: 100px;cursor: pointer" onclick="myFunction(this);">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 ml-auto">
                        <div class="art_desc">
                            <h3 class="art_name">{{$installation->name}}</h3>
                            <h3>{{$installation->location}}</h3>
                            @if(!empty($installation->art_id))
                                <h3 class="art_name">{{$installation->art->name}}</h3>
                            @endif
                            <h3 class="show-text-as-white-space">{{$installation->comment}}</h3>
                        </div>
                        <br><br>
                        @if(!empty($installation->art_id))
                            <div class="art_overview_btn">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <a href="#"
                                           class="btn btn-outline-light rounded-0 btn-block mt-3">
                                            VIEW SCULPTURE
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
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
</script>
