{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 27-Oct-16 4:22 PM
    * File Name    :

--}}
{!! Form::open(['route' => ['flag.save'], 'class'=> 'form-inline']) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Flag Listing</h4>
</div>

{!! Form::hidden('object_id', $object_id) !!}
{!! Form::hidden('object_type', $type) !!}

<div class="list-box">

    @foreach($reasons as $index=> $reason)
        <div class="form-group col-sm-6">
            <div class="checkbox">
                <label data-reason="{{$reason}}">
                    <input name="flag_reason[]" type="checkbox" value="{{$index}}">{{$reason}}
                </label>
            </div>
        </div>
    @endforeach

    <div class="form-group col-sm-12 hide" id="description">
        {!! Form::textarea('flag_description', NULL,['class' => 'form-control', 'id' => 'description-field']) !!}

    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-green" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-green">Save</button>
</div>
{!! Form::close() !!}
<script>
    $(function () {
        $('input[type="checkbox"]').click(function () {
            var reason = $(this).closest('label').data('reason');
            if ($(this).is(':checked')) {
                if (reason == 'Other') {
                    $('#description').removeClass('hide');
                    $('#description-field').prop('required', true);
                }
            } else {
                if (reason == 'Other') {
                    $('#description').addClass('hide');
                    $('#description-field').prop('required', false);
                }
            }
        });
    })
</script>
