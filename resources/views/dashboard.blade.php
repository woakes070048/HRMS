@extends('layouts.hrms')
@section('content')

<!-- Begin: Content -->
<section id="content" class="animated fadeIn">

<!-- Sister Concern -->
<div class="panel">
  <div class="panel-heading">
    <span class="panel-title">Sister Concern List</span>
  </div>
  <div class="panel-body panel-scroller scroller-dark scroller-sm scroller-overlay scroller-pn pn">
    <table class="table mbn tc-list-1 tc-text-muted-2 tc-fw600-2">
      <thead>
        <tr>
          <th class="w30">#</th>
          <th>Company Code</th>
          <th>Company Name</th>
          <th>Company Address</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1.</td>
          <td>Lorem ipsum dolor sit amet</td>
          <td><a href="{{url('/')}}">Lorem ipsum dolor sit amet</a></td>
          <td>Lorem ipsum dolor sit amet</td>
        </tr>
        
      </tbody>
    </table>

  </div>
</div>
</section>
<!-- End: Content -->

@endsection