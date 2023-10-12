<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/brands.min.css" integrity="sha512-W/zrbCncQnky/EzL+/AYwTtosvrM+YG/V6piQLSe2HuKS6cmbw89kjYkp3tWFn1dkWV7L1ruvJyKbLz73Vlgfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/regular.min.css" integrity="sha512-rOTVxSYNb4+/vo9pLIcNAv9yQVpC8DNcFDWPoc+gTv9SLu5H8W0Dn7QA4ffLHKA0wysdo6C5iqc+2LEO1miAow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/solid.min.css" integrity="sha512-P9pgMgcSNlLb4Z2WAB2sH5KBKGnBfyJnq+bhcfLCFusrRc4XdXrhfDluBl/usq75NF5gTDIMcwI1GaG5gju+Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/svg-with-js.min.css" integrity="sha512-4oP5WpLD1feGamTDxyKyYjJj9a15AlPfKOt78LpGmZ+XfrUcuC7hjHVTuzhJhO4pPvi3RHL6CI2Tyjdoik3AnA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/v4-font-face.min.css" integrity="sha512-sx5f0oBw5bYJXpvIAFXqCP3p5heQFrIDUJEUu2ja7WbmFHBHKY565OjQK2PQM+8PruMwcDR18WEIOse4qEBJ8Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/v4-shims.min.css" integrity="sha512-fWfO/7eGDprvp7/UATnfhpPDgF33fetj94tDv9q0z/WN4PDYiTP97+QcV1QWgpbkb+rUp76g6glID5mdf/K+SQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/v5-font-face.min.css" integrity="sha512-5zrDFDfoCqAqA6xPCDWHHy8cOXlRGgCy+/wh4eUwzJXAwyvBeBzCJ4AqVlasi+Dxr5b9qabJw67ocz+qsax4eQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route ('posts.create') }}" class="btn btn-md btn-success mb-3"><i class="fa fa-plus" aria-hidden="true"></i> TAMBAH POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">GAMBAR</th>
                                    <th scope="col">JUDUL</th>
                                    <th scope="col">CONTENT</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($posts))
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset('storage/posts/' . $post->image) }}" class="rounded" style="max-width: 150px; max-height: 150px;">

                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{!! $post->content !!}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDIT</a>
                                                    <a href="{{ route('posts.show', $post->id) }}" style="color: white;" class="btn btn-sm btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> SHOW</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i> HAPUS</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-danger">
                                                Data Post Belum Tersedia
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- {{ $posts->links() }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // message with toastr
        @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>
</html>
