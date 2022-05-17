 <!--Toggle-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap4-toggle.min.css')}}">
<style type="text/css">
	.container {
	  display: flex;
	  flex-wrap: wrap;
	  width: 720px;
	  justify-content: flex-start;
	}

	.single-item {
	  width: 200px;
	  height: 200px;
	  display: flex;
	  align-items: center;
	  justify-content: center;
	  background-color: #f3f3f3;
	  margin: 20px;
	  border-radius: 10px;
	  color: #888;
	}
	.pagination {
	  padding: 20px;
	}
	.pagination,
	.pagination * {
	  -webkit-user-select: none;
	     -moz-user-select: none;
	      -ms-user-select: none;
	          user-select: none;
	}
	.pagination a {
	  display: inline-block;
	  padding: 0 10px;
	  cursor: pointer;
	}
	.pagination a.disabled {
	  opacity: 0.3;
	  pointer-events: none;
	  cursor: not-allowed;
	}
	.pagination a.current {
	  background: #f3f3f3;
	}
</style>