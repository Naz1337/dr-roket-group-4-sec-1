<!-- PublicationReport.blade.php -->

<x-modern-layout>
    <div class="p-3 bg-white content">
        @if(isset($publications))
            <div class="container">
                <h1>Report Details</h1>
                <div class="card">
                    <div class="card-header">
                        Report Summary
                    </div>
                    <div class="card-body">
                        <!-- Display report details here -->
                        <p>Report generated on: {{ $reportDate }}</p>
                        <p>Total publications: {{ $totalPublications }}</p>
                        <!-- You can add more details as needed -->
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
                                    <!-- Add more table headers as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($publications as $publication)
                                    <tr>
                                        <td>{{ $publication->P_title }}</td>
                                        <td>{{ $publication->P_authors }}</td>
                                        <!-- Add more table cells with publication details -->
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
                    <label for="university" class="form-label">Select University:</label>
                    <select name="university" id="university" class="form-select">
                        <option value="university1">University 1</option>
                        <option value="university2">University 2</option>
                        <!-- Add more options here -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Select Year:</label>
                    <select name="year" id="year" class="form-select">
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <!-- Add more years or change as needed -->
                    </select>
                </div>
                <!-- Add more relevant options and filters here -->
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </form>
        @endif
    </div>
</x-modern-layout>
