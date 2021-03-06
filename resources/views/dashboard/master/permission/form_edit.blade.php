<div id="vue-form-element">
    <div class="sc-padding-small">
      
        <label class="uk-form-label" for="name">Name<sup>*</sup></label>
        <div class="uk-form-controls">
        <input class="uk-input" id="name" name="name" value="{{$data->name}}" type="text" data-sc-input="outline" required>
        </div>
        @error('name')
           
            <div class="uk-alert-danger" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                    {{ $message }}
            </div>
        @enderror
    </div>
    <div class="sc-padding-small">
      
        <label class="uk-form-label" for="display_name"> Display Name<sup>*</sup></label>
        <div class="uk-form-controls">
            <input class="uk-input" id="display_name" name="display_name" value="{{$data->display_name}}"  type="text" data-sc-input="outline" required>
        </div>
        @error('display_name')
           
            <div class="uk-alert-danger" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                    {{ $message }}
            </div>
        @enderror
    </div>
    <div class="uk-margin-medium-top sc-padding-small">
        <label class="uk-form-label" for="description">Description <sup>*</sup></label>
        <div class="uk-form-controls">
            <input class="uk-input" id="description" value="{{$data->description}}"  name="description" type="text" data-sc-input="outline" required>
        </div>
        @error('description')
               
            <div class="uk-alert-danger" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                    {{ $message }}
            </div>
        @enderror
    </div>
    
    <div class="uk-margin-medium-top sc-padding-small">
        <label class="uk-form-label" for="built_in">Built In<sup>*</sup></label>
        <div class="uk-form-controls">
            <select class="uk-select" id="built_in"   name="built_in" required>
                <option @if(is_null($data->built_in)) selected @endif value="">-- Choose Built In --</option>
                <option  @if($data->built_in == 0) selected @endif value="0">0</option>
                <option  @if($data->built_in == 1) selected @endif value="1">1</option>
               
                   
                
                
            
            </select>
        </div>
        @error('built_in')
           
            <div class="uk-alert-danger" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                    {{ $message }}
            </div>
        @enderror
    </div>
   