<table>
    <thead>
    <tr>
        <th><b>Transaction Number</b></th>
        <th><b>Ongkir</b></th>
        <th><b>Total</b></th>
        <th><b>Laba</b></th>
        <th><b>Nama Customer</b></th>
        <th><b>Alamat</b></th>
        <th><b>Admin</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->transaction_number }}</td>
            <td>{{ $transaction->ongkir }}</td>
            <td>{{\App\Utility\PosUtility::returnPrice($transaction->total)}}</td>
            <td>{{\App\Utility\PosUtility::returnPrice($transaction->laba)}}</td>
            <td>{{ $transaction->customer->name }}</td>
            <td>{{ $transaction->transaction_address->address }}</td>
            <td>{{ $transaction->user->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>