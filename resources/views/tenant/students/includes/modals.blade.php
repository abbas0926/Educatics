<!-- Modal add group -->
<div class="modal fade" id="AddGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Affecter à un groupe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('tenant.students.attach')}}" method="POST" >
                @csrf
                <div class="input-group mb-3">
                    
                    <select class="custom-select" id="group_id" name="group_id">
                      <option selected>Selectionner un groupe...</option>
                      @foreach ($student->studentPromotions->first()->promotionGroups as $group )
                      <option value="1">{{$group->name}}</option>
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <label class="input-group-text" for="inputGroupSelect02">Groupes</label>
                    </div>
                  </div>
                  <input name="student_id" type="text" hidden id="student_id" class="btn btn-primary" value="{{$student->id}}">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Savegarder</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal add group -->

  <!-- Modal Edit group -->
<div class="modal fade" id="EditGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Changer le groupe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('tenant.students.changeGroup')}}" method="POST" >
                @csrf
                <div class="input-group mb-3">
                    
                    <select class="custom-select" id="group_id" name="group_id">
                      <option selected>{{$student->studentGroups->first()->name}}</option>
                      @foreach ($student->studentPromotions->first()->promotionGroups as $group )
                      <option value="1">{{$group->name}}</option>
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <label class="input-group-text" for="inputGroupSelect02">Groupes</label>
                    </div>
                  </div>
                  <input name="student_id" type="text" hidden id="student_id" class="btn btn-primary" value="{{$student->id}}">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Savegarder</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal Edit group -->

  <!-- Modal Promotion group -->
<div class="modal fade" id="AddPromotionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Affecter à une promotion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('tenant.students.attachPromotion')}}" method="POST" >
                @csrf
                <div class="input-group mb-3">
                    
                    <select class="custom-select" id="promotion_id" name="promotion_id">
                      <option selected>Selectionner une promotion...</option>
                      @foreach ($promotions as $promotion )
                      <option value="1">{{$promotion->name}}</option>
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <label class="input-group-text" for="inputGroupSelect02">Promotion</label>
                    </div>
                  </div>
                  <input name="student_id" type="text" hidden id="student_id" class="btn btn-primary" value="{{$student->id}}">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Savegarder</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal add promotion -->

  <!-- Modal Edit promotion -->
<div class="modal fade" id="EditPromotionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Changer la promotion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('tenant.students.changePromotion')}}" method="POST" >
                @csrf
                <div class="input-group mb-3">
                    
                    <select class="custom-select" id="promotion_id" name="promotion_id">
                      <option selected>{{$student->studentPromotions->first()->name}}</option>
                      @foreach ($promotions as $promotion )
                      <option value="1">{{$promotion->name}}</option>
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <label class="input-group-text" for="inputGroupSelect02">Promotions</label>
                    </div>
                  </div>
                  <input name="student_id" type="text" hidden id="student_id" class="btn btn-primary" value="{{$student->id}}">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Savegarder</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal Edit promotion -->


  <!-- Modal add formation -->
<div class="modal fade" id="AddFormationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Affecter à une formation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('tenant.students.attachFormation')}}" method="POST" >
                @csrf
                <div class="input-group mb-3">
                    
                    <select class="custom-select" id="formation_id" name="formation_id">
                      <option selected>Selectionner une formation...</option>
                      @foreach ($formations as $formation )
                      <option value="1">{{$formation->title}}</option>
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <label class="input-group-text" for="inputGroupSelect02">Formations</label>
                    </div>
                  </div>
                  <input name="student_id" type="text" hidden id="student_id" class="btn btn-primary" value="{{$student->id}}">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Savegarder</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal add formation -->

  <!-- Modal Edit formation -->
<div class="modal fade" id="EditFormationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Changer la formation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('tenant.students.changePromotion')}}" method="POST" >
                @csrf
                <div class="input-group mb-3">
                    
                    <select class="custom-select" id="formation_id" name="formation_id">
                      <option selected>{{$student->studentPromotions->first()->formation->title}}</option>
                      @foreach ($formations as $formation )
                      <option value="1">{{$formation->title}}</option>
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <label class="input-group-text" for="inputGroupSelect02">Formations</label>
                    </div>
                  </div>
                  <input name="student_id" type="text" hidden id="student_id" class="btn btn-primary" value="{{$student->id}}">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Savegarder</button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal Edit formation -->