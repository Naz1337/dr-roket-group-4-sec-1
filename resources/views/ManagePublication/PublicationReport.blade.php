<x-modern-layout>
    <div class="p-3 bg-white content">
        @if(isset($publications))
            <div class="container">
                <h1>Report Details</h1>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Report Summary</span>
                        <form action="{{ route('publicationreport') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="filterType" value="{{ $filterType }}">
                            <input type="hidden" name="filterValue" value="{{ $filterValue }}">
                            <input type="hidden" name="year" value="{{ $selectedYear }}">
                            <input type="hidden" name="download" value="true">
                            <input type="hidden" name="excludeHeader" value="true">
                            <button type="submit" class="btn btn-secondary">Download Report</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <p>Report generated on: {{ $reportDate }}</p>
                        <p>Total publications: {{ $totalPublications }}</p>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        Publication List
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Authors</th>
                                    <th>Type</th>
                                    <th>Published Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($publications as $publication)
                                    <tr>
                                        <td>{{ $publication->P_title }}</td>
                                        <td>{{ $publication->P_authors }}</td>
                                        <td>{{ $publication->P_type }}</td>
                                        <td>{{ $publication->P_published_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <h2>Generate Publication Report</h2>
            <form action="{{ route('publicationreport') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="filterType" class="form-label">Filter By:</label>
                    <select name="filterType" id="filterType" class="form-select" onchange="updateFilterValueOptions()">
                        <option value="university" {{ old('filterType') == 'university' ? 'selected' : '' }}>University</option>
                        <option value="platinumName" {{ old('filterType') == 'platinumName' ? 'selected' : '' }}>Platinum Name</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="filterValue" class="form-label" id="filterValueLabel">
                        @if(old('filterType') == 'platinumName')
                            Select Platinum Name:
                        @else
                            Select University:
                        @endif
                    </label>
                    <select name="filterValue" id="filterValue" class="form-select">
                        @if(old('filterType') == 'platinumName')
                            <option value="all">All Platinum Names</option>
                            @foreach($platinumNames as $platinumName)
                                <option value="{{ $platinumName }}">{{ $platinumName }}</option>
                            @endforeach
                        @else
                            <option value="all">All Universities</option>
                            @foreach($universities as $university)
                                <option value="{{ $university }}">{{ $university }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Select Year:</label>
                    <select name="year" id="year" class="form-select">
                        <option value="any">Any Year</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </form>
        @endif
    </div>

    <script>
        function updateFilterValueOptions() {
            const filterType = document.getElementById('filterType').value;
            const filterValueSelect = document.getElementById('filterValue');
            const filterValueLabel = document.getElementById('filterValueLabel');
            let options = '';

            if (filterType === 'platinumName') {
                filterValueLabel.innerText = 'Select Platinum Name:';
                options += '<option value="all">All Platinum Names</option>';
                @foreach($platinumNames as $platinumName)
                    options += `<option value="{{ $platinumName }}">{{ $platinumName }}</option>`;
                @endforeach
            } else {
                filterValueLabel.innerText = 'Select University:';
                options += '<option value="all">All Universities</option>';
                @foreach($universities as $university)
                    options += `<option value="{{ $university }}">{{ $university }}</option>`;
                @endforeach
            }

            filterValueSelect.innerHTML = options;
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateFilterValueOptions();
        });
    </script>
</x-modern-layout>
