<!-- Enter Shot Modal -->
<div class="modal fade" id='boyShot' tabindex="-1" role="dialog" aria-labelledby="addGolferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content green-back">
      {!!Form::open(['action' => 'ShotController@store'])!!}
      {!!Form::hidden('page', 'landing')!!}
        <div class="modal-header">
            <p class="modal-title dayBoxHeader" id="addGolferModalLabel"></p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div style="margin:15px">
                <input type="hidden" name="boyId" id="hiddenBoyId">
                <input type="hidden" name="boyDay" id="hiddenBoyDay">
                <input type="text" class="form-control" style="margin-bottom:5px" placeholder="Score" name="total" required>
                <input type="text" class="form-control" placeholder="Skin" name="skin" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
          {!!Form::submit('Add Score',['class'=>'btn btn-primary btn-sm'])!!}
        </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>
