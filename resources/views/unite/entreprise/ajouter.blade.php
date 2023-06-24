@extends('layouts.admin')

@section('content')
 <h2 class="text-center" style="color: rgba(255, 0, 0, 0.627);">  اضافة مؤسسة </h2>

		<div class="container">
			<form action="{{ route('AddEntreprise') }}" method="post">
            <input type="hidden" name="_token" value="{{ Session::token() }}">

            @csrf
			<div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>الهاتف</label>
                        <input type="number" required name="telephone" class="form-control"
                        placeholder="رقم الهاتف" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>العنوان</label>
                        <input type="text"  name="adresse" class="form-control"
                            placeholder="العنوان " autocomplete="off">
                     </div>

                    <br/>
                    <p class="text-center">
                        <button type="submit" class="btn btn-success">اضافة</button>
                        <a href="{{route('ListEntrepise')}}" class="btn btn-secondary">خروج</a>
                    </p>
                </div>

                <div class="col-md-6">
    				<div class="form-group">
                        <label>اسم المؤسسة</label>
                        <input type="text" required name="nom" class="form-control"
                            placeholder="اسم المؤسسة" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>مدير المؤسسة</label>
                        <input type="text" required name="directeur" class="form-control"
                            placeholder="ام مدير المؤسسة " autocomplete="off">
                     </div>

                     <div class="form-group">
                        <label>البريد الالكتروني</label>
                        <input type="email" required name="email" class="form-control"
                            placeholder="البريد الالكتروني  " autocomplete="off">
                    </div>

                </div>

            </div>





             </form>
		</div>
   @endsection
