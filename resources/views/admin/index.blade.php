@extends('layouts.admin.master')

@section('title', __('dashboard.title'))

@section('content')
		<!-- Info boxes -->
		<div class="row">
		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box">
			  <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">ترافیک Cpu</span>
				<span class="info-box-number">
				  10
				  <small>%</small>
				</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>
		  <!-- /.col -->
		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-google-plus"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">لایک‌ها</span>
				<span class="info-box-number">41,410</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>
		  <!-- /.col -->

		  <!-- fix for small devices only -->
		  <div class="clearfix hidden-md-up"></div>

		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">فروش</span>
				<span class="info-box-number">760</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>
		  <!-- /.col -->
		  <div class="col-12 col-sm-6 col-md-3">
			<div class="info-box mb-3">
			  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

			  <div class="info-box-content">
				<span class="info-box-text">اعضای جدید</span>
				<span class="info-box-number">2,000</span>
			  </div>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>
		  <!-- /.col -->
		</div>
		<!-- /.row -->

		<div class="row">
		  <div class="col-md-12">
			<div class="card">
			  <div class="card-header">
				<h5 class="card-title">گزارش ماهیانه</h5>

				<div class="card-tools">
				  <button type="button" class="btn btn-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				  </button>
				  <div class="btn-group">
					<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
					  <i class="fa fa-wrench"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-left" role="menu">
					  <a href="#" class="dropdown-item">منو اول</a>
					  <a href="#" class="dropdown-item">منو دوم</a>
					  <a href="#" class="dropdown-item">منو سوم</a>
					  <a class="dropdown-divider"></a>
					  <a href="#" class="dropdown-item">لینک</a>
					</div>
				  </div>
				  <button type="button" class="btn btn-tool" data-widget="remove">
					<i class="fa fa-times"></i>
				  </button>
				</div>
			  </div>
			  <!-- /.card-header -->
			  <div class="card-body">
				<div class="row">
				  <div class="col-md-8">
					<p class="text-center">
					  <strong>فروش ۱ دی ۱۳۹۷</strong>
					</p>

					<div class="chart">
					  <!-- Sales Chart Canvas -->
					  <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
					</div>
					<!-- /.chart-responsive -->
				  </div>
				  <!-- /.col -->
				  <div class="col-md-4">
					<p class="text-center">
					  <strong>میزان پیشرفت اهداف</strong>
					</p>

					<div class="progress-group">
					  محصولات اضافه شده به سبد خرید
					  <span class="float-left"><b>160</b>/200</span>
					  <div class="progress progress-sm">
						<div class="progress-bar bg-primary" style="width: 80%"></div>
					  </div>
					</div>
					<!-- /.progress-group -->

					<div class="progress-group">
					  خرید انجام شده
					  <span class="float-left"><b>310</b>/400</span>
					  <div class="progress progress-sm">
						<div class="progress-bar bg-danger" style="width: 75%"></div>
					  </div>
					</div>

					<!-- /.progress-group -->
					<div class="progress-group">
					  <span class="progress-text">بازدید صفحات ویژه</span>
					  <span class="float-left"><b>480</b>/800</span>
					  <div class="progress progress-sm">
						<div class="progress-bar bg-success" style="width: 60%"></div>
					  </div>
					</div>

					<!-- /.progress-group -->
					<div class="progress-group">
					  سوالات ارسالی
					  <span class="float-left"><b>250</b>/500</span>
					  <div class="progress progress-sm">
						<div class="progress-bar bg-warning" style="width: 50%"></div>
					  </div>
					</div>
					<!-- /.progress-group -->
				  </div>
				  <!-- /.col -->
				</div>
				<!-- /.row -->
			  </div>
			  <!-- ./card-body -->
			  <div class="card-footer">
				<div class="row">
				  <div class="col-sm-3 col-6">
					<div class="description-block border-right">
					  <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 17%</span>
					  <h5 class="description-header">تومان 35,210.43</h5>
					  <span class="description-text">کل گردش حساب</span>
					</div>
					<!-- /.description-block -->
				  </div>
				  <!-- /.col -->
				  <div class="col-sm-3 col-6">
					<div class="description-block border-right">
					  <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i> 0%</span>
					  <h5 class="description-header">تومان 10,390.90</h5>
					  <span class="description-text">فروش کل</span>
					</div>
					<!-- /.description-block -->
				  </div>
				  <!-- /.col -->
				  <div class="col-sm-3 col-6">
					<div class="description-block border-right">
					  <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 20%</span>
					  <h5 class="description-header">تومان 24,813.53</h5>
					  <span class="description-text">سود کل</span>
					</div>
					<!-- /.description-block -->
				  </div>
				  <!-- /.col -->
				  <div class="col-sm-3 col-6">
					<div class="description-block">
					  <span class="description-percentage text-danger"><i class="fa fa-caret-down"></i> 18%</span>
					  <h5 class="description-header">1200</h5>
					  <span class="description-text">اهداف</span>
					</div>
					<!-- /.description-block -->
				  </div>
				</div>
				<!-- /.row -->
			  </div>
			  <!-- /.card-footer -->
			</div>
			<!-- /.card -->
		  </div>
		  <!-- /.col -->
		</div>
		<!-- /.row -->
@endsection