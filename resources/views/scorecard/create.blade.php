<!-- create new scorecard Modal -->
<div class="modal fade" id="addScorecardModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content green-back">
            {{Form::open(['action' => 'ScorecardController@store'])}}
                <div class="modal-header">
                    <p class="modal-title dayBoxHeader">Create New Scorecard</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div style="margin:15px">
                        <input type="text" name="name" placeholder="Course Name" class="form-control" required>
                    </div>
                    <div style="margin:15px">
                        <input type="text" name="courseRating" placeholder="Course Rating" class="form-control" required></td>
                    </div>
                    <div style="margin:15px">
                        <input type="text" name="slopeRating" placeholder="Slope Rating" class="form-control" required></td>
                    </div>
                    <div style="margin:15px">
                        <p>{{Form::radio('totalHoles', '9')}}  <span style="margin-right:25px">9 Holes</span>  {{Form::radio('totalHoles', '18', true)}} 18 Holes</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                    {!!Form::submit('Create',['class'=>'btn btn-primary btn-sm'])!!}
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
