<x-modern-layout>
    @vite('resources/js/ed_report.js')
    <div class="p-3 bg-white content">
        <div class="row p-3 bg bg-light">
            {{-- Content --}}
            <table class="table display mb-4" id="draftsTable" style="min-width: 100%">
                <thead>
                    <tr>
                        <th>Expert Name</th>
                        <th>Expert Affiliation</th>
                        <th>Expert Email</th>
                        <th>Email Phone Number</th>
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
                        <td>Not yet</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Total Page:</th>
                        <th class="text-end"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-modern-layout>