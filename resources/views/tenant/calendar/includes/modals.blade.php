  <!-- Modal Edit formation -->
  <div class="modal fade" id="EditFormationModal" tabindex="-1" role="dialog" aria-labelledby="EditFormationModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditFormationModal">Changer la formation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ajouter un Cours</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ajouter un Evenement</a>
                  </li>
                  
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form method="POST" action="{{ route("tenant.lessons.storeFromCalendar") }}" enctype="multipart/form-data">
                      @csrf
                      <br>
                      <div class="form-group">
                          <label class="required" for="group_id">{{ trans('cruds.lesson.fields.group') }}</label>
                          <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id" required>
                              @foreach($groups as $id => $entry)
                                  <option value="{{ $entry->id }}" {{ old('group_id') == $id ? 'selected' : '' }}>{{ $entry->name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('group'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('group') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.lesson.fields.group_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <label class="required" for="teacher_id">{{ trans('cruds.lesson.fields.teacher') }}</label>
                          <select class="form-control select2 {{ $errors->has('teacher') ? 'is-invalid' : '' }}" name="teacher_id" id="teacher_id" required>
                              @foreach($teachers as $id => $entry)
                                  <option value="{{  $entry->id }}" {{ old('teacher_id') == $id ? 'selected' : '' }}>{{ $entry->first_name }} {{ $entry->last_name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('teacher'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('teacher') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.lesson.fields.teacher_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <label class="required" for="start_at">{{ trans('cruds.lesson.fields.start_at') }}</label>
                          <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at') }}" required>
                          @if($errors->has('start_at'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('start_at') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.lesson.fields.start_at_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <label class="required" for="ends_at">{{ trans('cruds.lesson.fields.ends_at') }}</label>
                          <input class="form-control datetime {{ $errors->has('ends_at') ? 'is-invalid' : '' }}" type="text" name="ends_at" id="ends_at" value="{{ old('ends_at') }}" required>
                          @if($errors->has('ends_at'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('ends_at') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.lesson.fields.ends_at_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <label class="required" for="classroom_id">{{ trans('cruds.lesson.fields.classroom') }}</label>
                          <select class="form-control select2 {{ $errors->has('classroom') ? 'is-invalid' : '' }}" name="classroom_id" id="classroom_id" required>
                              @foreach($classrooms as $id => $entry)
                                  <option value="{{  $entry->id }}" {{ old('classroom_id') == $id ? 'selected' : '' }}>{{ $entry->name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('classroom'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('classroom') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.lesson.fields.classroom_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <div class="form-check {{ $errors->has('done') ? 'is-invalid' : '' }}">
                              <input type="hidden" name="done" value="0">
                              <input class="form-check-input" type="checkbox" name="done" id="done" value="1" {{ old('done', 0) == 1 ? 'checked' : '' }}>
                              <label class="form-check-label" for="done">{{ trans('cruds.lesson.fields.done') }}</label>
                          </div>
                          @if($errors->has('done'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('done') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.lesson.fields.done_helper') }}</span>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Savegarder</button>
                    </div>
                    

                    
                    </form>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <form method="POST" action="{{ route("tenant.events.storeFromCalendar") }}" enctype="multipart/form-data">
                      @csrf
                      <br>
                      <div class="form-group">
                          <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                          <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                          @if($errors->has('title'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('title') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <label for="price">{{ trans('cruds.event.fields.price') }}</label>
                          <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                          @if($errors->has('price'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('price') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.event.fields.price_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <label for="start_at">{{ trans('cruds.event.fields.start_at') }}</label>
                          <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at') }}">
                          @if($errors->has('start_at'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('start_at') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.event.fields.start_at_helper') }}</span>
                      </div>
                      <div class="form-group">
                          <label for="ends_at">{{ trans('cruds.event.fields.ends_at') }}</label>
                          <input class="form-control datetime {{ $errors->has('ends_at') ? 'is-invalid' : '' }}" type="text" name="ends_at" id="ends_at" value="{{ old('ends_at') }}">
                          @if($errors->has('ends_at'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('ends_at') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.event.fields.ends_at_helper') }}</span>
                      </div>
                <div class="form-group">
                          <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                          <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                          @if($errors->has('description'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('description') }}
                              </div>
                          @endif
                          <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Savegarder</button>
                    </div>
               </form>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
                <div class="input-group mb-3">
                    
                    
                  
            
        </div>
        
      </div>
    </div>
  </div>

  <!-- Modal Edit formation -->