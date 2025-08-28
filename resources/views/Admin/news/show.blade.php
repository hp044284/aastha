@extends('Admin.Layout.index')
@push('css')
<style>
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endpush
@section('title','News Details')
@section('content')

<div class="row">
    <div class="col-xl-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">News Details</h5>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Title</th>
                                <td>{{ $news->title }}</td>
                            </tr>
                            <tr>
                                <th>Subtitle</th>
                                <td>{{ $news->subtitle ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>News URL</th>
                                <td>
                                    @if($news->news_url)
                                        <a href="{{ $news->news_url }}" target="_blank">{{ $news->news_url }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Video URL</th>
                                <td>
                                    @if($news->video_url)
                                        <a href="{{ $news->video_url }}" target="_blank">{{ $news->video_url }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>File</th>
                                <td>
                                    @if(!empty($news->file_name))
                                        @php
                                            $fileUrl = asset('storage/uploads/news/' . $news->file_name);
                                            $isImage = false;
                                            if (!empty($news->file_type)) {
                                                $isImage = Str::startsWith($news->file_type, 'image/');
                                            } else {
                                                $ext = strtolower(pathinfo($news->file_name, PATHINFO_EXTENSION));
                                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                            }
                                        @endphp
                                        @if($isImage)
                                            <img src="{{ $fileUrl }}" alt="News Image" class="img-fluid rounded" style="max-width:200px;max-height:200px;">
                                            <div>
                                                <a href="{{ $fileUrl }}" target="_blank">{{ $news->file_name }}</a>
                                            </div>
                                        @elseif(Str::endsWith(strtolower($news->file_name), '.pdf'))
                                            <a href="{{ $fileUrl }}" target="_blank">
                                                <i class="bx bxs-file-pdf" style="font-size:1.5rem;color:#d32f2f;"></i>
                                                View PDF
                                            </a>
                                        @else
                                            <a href="{{ $fileUrl }}" target="_blank">{{ $news->file_name }}</a>
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>File Type</th>
                                <td>{{ $news->file_type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Event</th>
                                <td>{{ $news->event ? $news->event->title : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge {{ $news->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $news->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('news.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
