
<h1>Relatório diário de vendas</h1>

Olá {{ $sellerName }},<br/>

<p>Aqui está o seu relatiorio diário de vendas do dia {{ $date }}:</p>

<b>Valor total vendido</b> {{ $totalSales }}<br/>
<b>Valor total pago em comissões</b> {{ $totalCommissions }}<br/>

<p>Obrigado pelo empenho no trabalho!</p>
<br/>
Thanks,<br>
{{ config('app.name') }}
