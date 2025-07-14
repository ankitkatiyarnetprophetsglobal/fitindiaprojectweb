@extends('admin.layouts.app')
@section('title', 'Fit India Admin-All Posts')

@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Posts</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
     <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
      <div class="card">
        <div class="card-header">
        <div class="row">
          <div class="col-md-2">
              @if(Auth::user()->role_id != 9)
                <a href="{{ route('admin.posts.create') }}">
                  <input type="submit" value="Create New Posts" class="btn btn-sm btn-success float-left">
                </a>
              @endif
              <div class="card-tools float-sm-left">No of Posts: <strong>{{ $post_count }}</strong></div><br>
            </div>
                <div class="col-md-10">
                    <form class="form-inline my-2 my-lg-0 rtside " method="GET" action="{{ route('admin.posts.index') }}">
                        <div class="form-group rtside">
                        {{-- <option data-name="{{ $post_cat->id }}" value="{{ $post_cat->id }}">{{ $post_cat->name }}</option>  --}}
                        <select class="custom-select custom-select mb-3" name="postcategory" id="category" style="width:180px" >
                        <option value="">Select Category</option>
                            @foreach($post_category as $post_cat)
                            <option data-name="{{ $post_cat->id }}" value="{{ $post_cat->id }}"
                            @if(!empty($_GET['postcategory']))
                            <?php //if($post_cat->id == $_GET['postcategory']){ echo 'selected'; } ?>
                                <?php if($post_cat->id == $postcategory){ echo 'selected'; } ?>
                                {{-- @php
                                $checked = "checked";
                                @endphp --}}
                            @endif
                            >{{ $post_cat->name }}</option>
                            @endforeach
                        </select>
                        <button type="search" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                        </div>
                    </form>
                </div>
          </div>
        </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">

          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="15%">Title</th>
                    <th scope="col" width="15%">Category</th>
                    <th scope="col" width="20%">Description</th>
                    <th scope="col" width="20%">Language</th>
                    <th scope="col" width="15%">Post Type</th>
                    <th scope="col" width="40px">Image</th>
                    <th scope="col" width="15%">Status</th>
                    @if(Auth::user()->role_id == 9)
                      <th scope="col" width="25%">Comment Count</th>
                    @endif
                    <th scope="col" width="25%">Action</th>
                    {{-- <th scope="col"></th> --}}
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>

                @foreach ($posts as $post)
                {{-- {{ dd($post->post_category_wise) }} --}}
                  <tr>
                    <th scope="row">{{++$i}}</th>

                    <td>{{ ucwords($post->title) }}</td>
                    <td>
                      @foreach($post->post_category as $k => $val)
                        {{ ucwords($val->name) }}
                        <br/>
                      @endforeach
                    </td>
                    {{-- <td>{{ $post->description }}</td> --}}
                    <td>
                      <?php
                        echo mb_strimwidth($post->description, 0, 50, "...");
                        //echo wordwrap($post->description, 8, "\n", false);
                      ?>
                    </td>
                    <td>{{ $post['getPostwiselanguage'][0]['name'] ?? '' }}</td>
                    <td>
                      @if($post->post_category_wise == 'post_article')
                            Article
                      @elseif($post->post_category_wise == 'video')
                            Video
                      @else
                            Article
                      @endif
                    </td>
                    <td>
                        <img src= "{{ $post->image }}" width="70px">
                    </td>
                    <td>
                        @if($post->published == 0)
                          Pending
                        @elseif($post->published == 1)
                          Waiting for approval
                        @elseif($post->published == 2)
                          Approved
                        @elseif($post->published == 3)
                          Rejected
                        @else
                          No Status
                        @endif
                    </td>
                    @if(Auth::user()->role_id == 9)
                      <td>{{ $post->get_postwisecommentcount_count ?? '' }}</td>
                    @endif
                     <td style="width:120px;display:inline-flex !important;">
                      <a class="btn btn-info btn-xs" href="{{ route('admin.posts.show',$post->id) }}" title="View">
                        <i class="fa fa-eye"  aria-hidden="true"></i>
                      </a>
                      @if(Auth::user()->role_id != 9)
                        {{-- <a class="btn btn-info btn-xs" href="{{ route('admin.posts.show',$post->id) }}">
                          <i class="fa fa-eye" title="View" aria-hidden="true"></i>
                        </a> --}}
                        &nbsp;&nbsp;
                          @if($post->published == 0 || $post->published == 3)
                            <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.posts.edit',$post->id) }}" title="Edit">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            &nbsp;&nbsp;
                          @endif
                        @if(Auth::user()->role_id == 8)
                          @if($post->published == 0 || $post->published == 3)
                            <a style="display: inline !important;" class="btn btn-info btn-xs" title="Send to Approval" href="{{ route('admin.SendToApproval',[$post->id]) }}">
                              <svg title="Send to Approval" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                              {{-- <i class="fa-solid fa-check"></i> --}}
                              {{-- Send to Approval --}}
                              {{-- <i class="fas fa-pencil-alt"></i> --}}
                            </a>
                            &nbsp;&nbsp;
                          @endif
                        @endif
                        @if($post->published == 0 || $post->published == 3)
                          <form action="{{ route('admin.posts.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit" title="Delete">
                              <i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete?')" ></i>&nbsp;
                            </button>
                          </form>
                        @endif
                      @endif
                        @if(Auth::user()->role_id == 9)
                          @if($post->published == 1)
                            {{-- <a class="btn btn-info btn-xs" href="{{ route('admin.posts.show',$post->id) }}">
                              <i class="fa fa-eye" title="View" aria-hidden="true"></i>
                            </a> --}}
                            &nbsp;&nbsp;
                            <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.ReadyToPublish',$post->id) }}">
                              Ready To Publish
                              {{-- <i class="fas fa-pencil-alt"></i> --}}
                            </a>
                            &nbsp;&nbsp;
                            <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.Rejected',[$post->id]) }}">
                              Rejected
                              {{-- <i class="fas fa-pencil-alt"></i> --}}
                            </a>
                            &nbsp;&nbsp;
                          @endif
                        @endif
                     </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="d-flex justify-content-center">
           {{ $posts->links() }}
         </div>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>

  </div>
@endsection
