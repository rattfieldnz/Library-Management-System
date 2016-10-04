@extends('layouts.app')
@section('title', 'Book Borrowing Management')
@section('content')
<section class="section--center mdl-grid mdl-grid--no-spacing">
<table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Borrowing Allowed</th>
      <th>Title</th>
      <th>Borrower</th>
      <th>Borrowing Time</th>
      <th>Return Time</th>
      <th class="mdl-data-table__cell--non-numeric">Return Books</th>
    </tr>
  </thead>
  <tbody>
    @foreach($records as $record)
    <tr>
      <td>
      @if( $record->enable == 0)
        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="enable-{{ $record->id }}">
          <input type="checkbox" id="enable-{{ $record->id }}" name="enable_btn" class="mdl-switch__input" {{ $record->enable==1?'checked="checked"':'' }}>
        </label>
        @endif
      </td>
      <td class="mdl-data-table__cell--non-numeric">{{ $record->book_name }}</td>
      <td>{{ $record->user_name }}</td>
      <td>{{ date('Y-m-d H:i', $record->time) }}</td>
      <td>
      @if( $record->return_time > 0 )
          {{ date('Y-m-d H:i', $record->return_time) }}
      @elseif(($record->time+86400*60) < time())
           Expired
      @elseif(($record->time+86400*50) < time())
           Overdue Soon
      @else
          Not Returned
      @endif
      </td>
      <td>
      @if( $record->return_time == 0 && $record->enable == 1)
          <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="return-{{ $record->id }}">
            <input type="checkbox" id="return-{{ $record->id }}" name="return_btn" class="mdl-switch__input">
          </label>
      @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</section>

<script type="text/javascript">
    $("[name='enable_btn']").each(function(){
      $(this).click(function(event){
        if(confirm('Allow this book to be borrowed for current user?')){
          $.ajax({
               url: '/manage/' + $(this).attr('id').replace('enable-',''),
               type: 'PUT',
               dataType: 'json',
               data: {
                  column: 'enable',
                  value: '1'
             },
             success: function(result) {
                  alert(result.status==1?'Please register the book with the borrower.':'Registration failed. Please try again later!');
             }
          });
        }else{
          event.stopPropagation();
        }
      });
    });
    $("[name='return_btn']").each(function(){
      $(this).click(function(event){
        if(confirm('Are you sure the book has been returned?')){
          $.ajax({
               url: '/manage/' + $(this).attr('id').replace('return-',''),
               type: 'PUT',
               dataType: 'json',
               data: {
                  column: 'return_time',
                  value: '1'
             },
             success: function(result) {
                  alert(result.status==1?'Please register the book with the borrower.':'Registration failed. Please try again later!');
             }
          });
        }else{
          event.stopPropagation();
        }
      });
    });
</script>

@endsection
