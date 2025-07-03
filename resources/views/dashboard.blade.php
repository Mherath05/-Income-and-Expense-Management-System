@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>

<div class="stats">
    <div class="stat-card">
        <h3>Total Income</h3>
        <h2>${{ number_format($totalIncome, 2) }}</h2>
    </div>
    <div class="stat-card">
        <h3>Total Expenses</h3>
        <h2>${{ number_format($totalExpense, 2) }}</h2>
    </div>
    <div class="stat-card">
        <h3>Balance</h3>
        <h2 style="color: {{ $balance >= 0 ? 'green' : 'red' }}">
            ${{ number_format($balance, 2) }}
        </h2>
    </div>
</div>

<div style="margin-bottom: 2rem;">
    <a href="{{ route('transactions.create') }}" class="btn btn-success">Add Transaction</a>
    <a href="{{ route('categories.create') }}" class="btn">Add Category</a>
</div>

<div style="margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>Income vs Expense Overview</h2>
        <div>
            <button id="barChartBtn" class="btn btn-sm" onclick="changeChartType('bar')" style="margin-right: 5px;">Bar Chart</button>
            <button id="lineChartBtn" class="btn btn-sm" onclick="changeChartType('line')">Line Chart</button>
        </div>
    </div>
    
    <div style="background: white; padding: 100px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <canvas id="incomeExpenseChart" style="height: 300px;"></canvas>
    </div>

    <div style="margin-top: 1rem; padding: 15px; background: #f8f9fa; border-radius: 8px;">
        <div style="display: flex; justify-content: space-around; text-align: center;">
            <div>
                <strong style="color: #28a745;">Avg Monthly Income</strong><br>
                <span id="avgIncome">$0</span>
            </div>
            <div>
                <strong style="color: #dc3545;">Avg Monthly Expense</strong><br>
                <span id="avgExpense">$0</span>
            </div>
            <div>
                <strong style="color: #17a2b8;">Best Month</strong><br>
                <span id="bestMonth">-</span>
            </div>
        </div>
    </div>
</div>

<h2>Recent Transactions</h2>
@if($recentTransactions->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Category</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentTransactions as $transaction)
            <tr>
                <td>{{ $transaction->date->format('M d, Y') }}</td>
                <td>{{ $transaction->title }}</td>
                <td>{{ $transaction->category->name }}</td>
                <td>
                    <span style="color: {{ $transaction->type == 'income' ? 'green' : 'red' }}">
                        {{ ucfirst($transaction->type) }}
                    </span>
                </td>
                <td>${{ number_format($transaction->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('transactions.index') }}" class="btn btn-view-all">View All Transactions</a>

@else
    <p>No transactions found. <a href="{{ route('transactions.create') }}">Add your first transaction</a></p>
@endif

@if($monthlyData->count() > 0)
<h2>Monthly Summary ({{ now()->year }})</h2>
<table class="table">
    <thead>
        <tr>
            <th>Month</th>
            <th>Income</th>
            <th>Expenses</th>
            <th>Net</th>
        </tr>
    </thead>
    <tbody>
        @foreach($monthlyData as $data)
        <tr>
            <td>{{ DateTime::createFromFormat('!m', $data->month)->format('F') }}</td>
            <td style="color: green">${{ number_format($data->income, 2) }}</td>
            <td style="color: red">${{ number_format($data->expense, 2) }}</td>
            <td style="color: {{ ($data->income - $data->expense) >= 0 ? 'green' : 'red' }}">
                ${{ number_format($data->income - $data->expense, 2) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
let chart;
let currentChartType = 'bar';

document.addEventListener('DOMContentLoaded', function() {

    const monthlyData = @json($monthlyData ?? collect());
    

    const months = [];
    const incomeData = [];
    const expenseData = [];
    
    monthlyData.forEach(function(data) {
        const monthName = new Date(2023, data.month - 1, 1).toLocaleString('default', { month: 'short' });
        months.push(monthName);
        incomeData.push(parseFloat(data.income) || 0);
        expenseData.push(parseFloat(data.expense) || 0);
    });
    

    if (months.length === 0) {
        const currentMonth = new Date().toLocaleString('default', { month: 'short' });
        months.push(currentMonth);
        incomeData.push(parseFloat({{ $totalIncome ?? 0 }}));
        expenseData.push(parseFloat({{ $totalExpense ?? 0 }}));
    }
    
    const avgIncome = incomeData.reduce((a, b) => a + b, 0) / incomeData.length;
    const avgExpense = expenseData.reduce((a, b) => a + b, 0) / expenseData.length;
    const netAmounts = incomeData.map((income, index) => income - expenseData[index]);
    const bestMonthIndex = netAmounts.indexOf(Math.max(...netAmounts));
    
    document.getElementById('avgIncome').textContent = '$' + avgIncome.toLocaleString(undefined, {maximumFractionDigits: 0});
    document.getElementById('avgExpense').textContent = '$' + avgExpense.toLocaleString(undefined, {maximumFractionDigits: 0});
    document.getElementById('bestMonth').textContent = months[bestMonthIndex] || '-';
    
    createChart('bar', months, incomeData, expenseData);
    updateChartButtons();
});

function createChart(type, labels, incomeData, expenseData) {
    const ctx = document.getElementById('incomeExpenseChart').getContext('2d');
    
    if (chart) {
        chart.destroy();
    }
    
    const config = {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: 'Income',
                data: incomeData,
                backgroundColor: type === 'line' ? 'rgba(40, 167, 69, 0.2)' : 'rgba(40, 167, 69, 0.8)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 2,
                fill: type === 'line' ? false : true,
                tension: type === 'line' ? 0.4 : 0
            }, {
                label: 'Expense',
                data: expenseData,
                backgroundColor: type === 'line' ? 'rgba(220, 53, 69, 0.2)' : 'rgba(220, 53, 69, 0.8)',
                borderColor: 'rgba(220, 53, 69, 1)',
                borderWidth: 2,
                fill: type === 'line' ? false : true,
                tension: type === 'line' ? 0.4 : 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Income vs Expenses - Last 12 Months',
                    font: {
                        size: 16
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': $' + context.parsed.y.toLocaleString();
                        },
                        footer: function(tooltipItems) {
                            let income = 0;
                            let expense = 0;
                            tooltipItems.forEach(function(tooltipItem) {
                                if (tooltipItem.dataset.label === 'Income') {
                                    income = tooltipItem.parsed.y;
                                } else if (tooltipItem.dataset.label === 'Expense') {
                                    expense = tooltipItem.parsed.y;
                                }
                            });
                            const net = income - expense;
                            return 'Net: $' + net.toLocaleString();
                        }
                    }
                }
            }
        }
    };
    
    chart = new Chart(ctx, config);
}

function changeChartType(type) {
    currentChartType = type;
    const monthlyData = @json($monthlyData ?? collect());
    
    const months = [];
    const incomeData = [];
    const expenseData = [];
    
    monthlyData.forEach(function(data) {
        const monthName = new Date(2023, data.month - 1, 1).toLocaleString('default', { month: 'short' });
        months.push(monthName);
        incomeData.push(parseFloat(data.income) || 0);
        expenseData.push(parseFloat(data.expense) || 0);
    });
    
    if (months.length === 0) {
        const currentMonth = new Date().toLocaleString('default', { month: 'short' });
        months.push(currentMonth);
        incomeData.push(parseFloat({{ $totalIncome ?? 0 }}));
        expenseData.push(parseFloat({{ $totalExpense ?? 0 }}));
    }
    
    createChart(type, months, incomeData, expenseData);
    updateChartButtons();
}

function updateChartButtons() {
    document.getElementById('barChartBtn').style.backgroundColor = currentChartType === 'bar' ? '#007bff' : '#6c757d';
    document.getElementById('lineChartBtn').style.backgroundColor = currentChartType === 'line' ? '#007bff' : '#6c757d';
}
</script>

<style>
.btn-sm {
    padding: 4px 8px;
    font-size: 12px;
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-sm:hover {
    background-color: #5a6268;
}
</style>
@endsection