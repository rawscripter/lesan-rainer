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

    h3.ex-des {
        line-height: 29px;
        font-weight: normal;
        text-align: justify;
        white-space: pre-wrap;
        font-size: 15px;
    }
</style>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-4">
                <div class="row p-0">
                    <div class="col-12 m-auto p-0">
                        <div class="image_overview">
                            <img id="expandedImg" src="/images/feature/{{$exhibition->image}}" style="width:100%">
                        </div>
                    </div>
                    <div class="col-md-12 ml-auto">
                        <div class="art_desc text-center">
                            <h3 class="art_name p-2">{{$exhibition->title}}</h3>
                            <h3>{{$exhibition->year}}</h3>
                            <h3 class="ex-des">{!! $exhibition->body !!}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
