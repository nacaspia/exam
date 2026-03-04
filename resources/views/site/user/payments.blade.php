@extends('site.user.layouts.app')

@section('site.user.css')
    <style>
        /* mobil üçün */
        .payments-table-wrap{
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .payments-table{
            min-width: 900px; /* sütunlar çoxdu deyə */
        }
    </style>
@endsection

@section('site.user.content')
    <div>
        <div class="container-fluid">

            <div class="admin-top-bar students-top">
                <div class="courses-select">
                    <h4 class="title">Ödənişlər</h4>
                </div>
            </div>

            @if(!empty($payments[0]))
                <div class="payments-table-wrap">
                    <table class="table table-dashed table-hover table-striped payments-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>İmtahan</th>
                            <th>Məbləğ</th>
                            <th>Status</th>
                            <th>Ödənişi etdiyi tarix</th>
                            <th>Ödənişi tamamladığı tarix</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment['id'] }}</td>
                                <td>{{ $payment['exam']['title'][language()] ?? '-' }}</td>
                                <td>{{ $payment['amount'] }}</td>
                                <td>
                                    {{ $payment['status'] === 'pending' ? 'Gözləyir' : 'Tamamlanıb' }}
                                </td>
                                <td>{{ date('d.m.Y H:i:s', strtotime($payment['created_at'])) }}</td>
                                <td>{{ date('d.m.Y H:i:s', strtotime($payment['updated_at'])) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="title">Məlumat yoxdur.</p>
            @endif

        </div>
    </div>
@endsection

@section('site.user.js')
@endsection
