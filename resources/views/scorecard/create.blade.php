<!-- create new Boys  Modal -->
<div class="modal fade" id="addGolferModal" tabindex="-1" role="dialog" aria-labelledby="addGolferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!!Form::open(['action' => 'BoyController@store'])!!}
                <div class="modal-header">
                    <h5 class="modal-title">Enter New Golfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div style="margin:15px">
                        <input type="text" class="form-control" placeholder="First Name" name="firstName" required>
                    </div>
                    <div style="margin:15px">
                        <input type="text" class="form-control" placeholder="Lirst Name" name="lastName" required>
                    </div>
                    <div style="margin: 0px 30px">
                        <div class="row">
                            <div class="column">
                                <p>{!!Form::checkbox('mon', 1, false,['class' => 'addBoyCheckbox'])!!} Monday</p>
                                <p>{!!Form::checkbox('wed', 1, false,['class' => 'addBoyCheckbox'])!!} Wednesday</p>
                            </div>
                            <div class="column">
                                <p>{!!Form::checkbox('fri', 1, false,['class' => 'addBoyCheckbox'])!!} Friday</p>
                                <p>{!!Form::checkbox('out', 1, false,['class' => 'addBoyCheckbox'])!!} Outing</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        {!!Form::submit('Add Golfer',['class'=>'btn btn-success btn-sm'])!!}
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>





@extends('layouts.template')
@section('content')
{{Form::open(['action' => 'ScorecardController@store'])}}
    <div class="flex-center position-ref full-height">
        <div class="form-group">
            <h3>Create New Scorecard</h3>
            <div>
                {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Course Name'] )!!}
            </div>
            <div class="top-margin">
                <p>{{Form::radio('totalHoles', '9')}}  <span style="margin-right:25px">9 Holes</span>  {{Form::radio('totalHoles', '18', true)}} 18 Holes</p>
            </div>
            <div style="text-align: right">
                <a href="url('/')" class="btn btn-primary btn-sm">Back</a>
                 {!!Form::submit('Create',['class'=>'btn btn-success btn-sm'])!!}
            </div>
        </div>
    </div>
{!!Form::close()!!}
@endsection
