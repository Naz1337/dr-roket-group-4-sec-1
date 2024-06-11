<x-modern-layout>
    @vite('resources/js/ed_report.js')
    <div class="p-3 bg-white content">
        <div class="row bg bg-light">
            {{-- Content --}}
            <div class="col">
                <div class="row p-3">
                    <table class="table display mb-4" id="expertTable" style="min-width: 100%">
                        <thead>
                            <tr>
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
                <form action="{{ route('download-report') }}" method="POST">
                    @csrf
                    <div class="row p-3 bg-light">
                        <div class="col-4">
                            <div class="row p-2"> 
                                <p>Download as:</p>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row p-3">
                                        <select class="form form-control" name="filetype" >
                                            <option value="PDF">PDF</option>
                                            <option value="Excel">Excel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row p-3">
                                        <button class="btn btn-primary" type="submit">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-modern-layout>