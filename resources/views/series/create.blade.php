<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label for="name" class="form-label">Nome:</label>
                <input
                    autofocus
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    id="name"
                    class="form-control">
            </div>
            <div class="col-2">
                <label for="seasons" class="form-label">Temporadas:</label>
                <input
                    type="text"
                    name="seasons"
                    value="{{ old('seasons') }}"
                    id="seasons"
                    class="form-control">
            </div>
            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Eps/Temporadas:</label>
                <input
                    type="text"
                    name="episodesPerSeason"
                    value="{{ old('episodesPerSeason') }}"
                    id="episodesPerSeason"
                    class="form-control">
            </div>
        </div>
        <div class="row mb-3">
           <div class="col-12">
                <label for="cover" class="form-label">Capa</label>
                <input type="file" name="cover" id="cover" class="form-control" accept="image/*">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</x-layout>
