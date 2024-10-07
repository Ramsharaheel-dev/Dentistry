@extends ('layouts.layout')

@section('head')
    <title>PubMed &#8211; Dian</title>
    <link rel='stylesheet' id='font-awesome-css' href="{{ asset('css/pubMed.css') }}" />
@endsection

@section('content')
    @include('requires.header')
    @include('requires.content-section')
    <div id="activeMenu" value="{{ $activeMenu }}"></div>
    <div class="container">
        <div class="pubMedContainer">
            <h1>PubMed search</h1>
            <form id="pubmedSearchForm" method="POST" target="_blank" action="{{ route('submitPubMed') }}">
                @csrf
                <input type="text" id="searchQuery" name="searchWord" placeholder="Enter your search term...">
                <button type="submit" class="pubMedFormSubmit">Search</button>
            </form>
        </div>
    </div>


    <!-- <div id="searchResults"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#pubmedSearchForm').submit(function(event) {
            event.preventDefault();
            const searchQuery = $('#searchQuery').val();
            performPubMedSearch(searchQuery);
        });

        function performPubMedSearch(query) {
            const apiUrl =
                `https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&retmode=json&term=${encodeURIComponent(query)}`;

            $.ajax({
                url: apiUrl,
                method: 'GET',
                success: function(data) {
                    displaySearchResults(data);
                },
                error: function(error) {
                    console.error('Error performing PubMed search:', error);
                }
            });
        }

        function displaySearchResults(data) {
            const searchResultsDiv = $('#searchResults');
            searchResultsDiv.empty();
            console.log(data.esearchresult);

            if (data.esearchresult.count > 0) {
                const results = data.esearchresult.idlist;
                results.forEach(function(result) {
                    const articleUrl = `https://pubmed.ncbi.nlm.nih.gov/${result}`;
                    searchResultsDiv.append(`<p><a href="${articleUrl}" target="_blank">${result}</a></p>`);
                });
            } else {
                searchResultsDiv.append('<p>No results found.</p>');
            }
        }
    </script> -->
@endsection
