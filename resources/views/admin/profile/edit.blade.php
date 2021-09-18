<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Профиль') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {!! Form::open([
                        'route' => 'admin.profile.avatar',
                        'method' => 'PUT',
                        "enctype" => "multipart/form-data",
                        'files' => true
                    ]) !!}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Укажите ID юзера кому будем менять аватар</label>
                        {{ Form::text('user_id', null, ['class' => 'form-control', 'required']) }}
                        <label for="exampleInputEmail1" class="form-label mt-3">Сменить аватар</label>
                        <br>
                        {!! Form::file('image', ['class'=>'btn btn-primary']) !!}
                        <br>
                        <small>
                            Только: png,jpg,jpeg,gif | Максимальный размер: 10 МБ
                        </small>
                    </div>
                    <button type="submit" class="btn btn-success">Загрузить аватар</button>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
