<x-modern-layout>
    @vite('resources/js/ed_report.js')
    <div class="p-3 bg-white content">
        <h1>Generate Report</h1>
        <div class="row bg bg-light">
            {{-- Content --}}
            <form action="{{ route('generate-report') }}" method="POST">
            @csrf
                <div class="col">
                    <div class="row p-3">
                        <div class="col-1">
                            <label class="form form-label p-2">Search:</label>
                        </div>
                        <div class="col">
                            <input class="form form-control" list="datalistOptions" name="search" type="text" placeholder="Search...">
                            <datalist id="datalistOptions">
                                <option value="Software Security">
                                <option value="Robotics">
                                <option value="Pattern Recognition">
                                <option value="Biotechnology">
                                <option value="Cloud Architecture">
                            </datalist>
                        </div>
                        <div class="col-2">
                            <i class="bi bi-search"></i>
                            &nbsp;
                            <button type="submit" class="btn btn-primary text-decoration-none">Search</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row p-3">
                                <table class="table table-hover" id="reportTable" style="min-width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Expert Name</th>
                                            <th>Expert Affiliation</th>
                                            <th>Expert Email</th>
                                            <th>Expert Phone Number</th>
                                            <th>Expert Research</th>
                                            <th>Expert Publication</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($myexperts as $expert)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $expert->expert_domain_names }}</td>
                                            <td>{{ $expert->expert_domain_affiliation }}</td>
                                            <td>{{ $expert->expert_domain_emails }}</td>
                                            <td>{{ $expert->expert_domain_phonenumbers }}</td>
                                            <td>{{ $expert->expert_domain_research_title }}</td>
                                            <td>
                                                @if(!$expert->publication->isEmpty())
                                                    @foreach ($expert->publication as $item)
                                                        Title: {{ $item->P_title }}
                                                    @endforeach
                                                @else
                                                    There are no publications
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        {{-- <tr>
                                            <th colspan="5" class="text-end">Total Page:</th>
                                            <th class="text-end"></th>
                                        </tr> --}}
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row p-3 bg-light">
                                <div class="col-4">
                                    <div class="row p-2"> 
                                        {{-- <p>Download as:</p> --}}
                                    </div>
                                    <div class="row">
                                        {{-- <div class="col">
                                            <div class="row p-3">
                                                <select class="form form-control" name="filetype">
                                                    <option value="PDF">PDF</option>
                                                    <option value="Excel">Excel</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col">
                                            <div class="row p-3">
                                                <a href="{{ route('download-report') }}" class="btn btn-primary" type="button">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-modern-layout>