<p>xlsx出力。spreadsheetで開くと正常に見えますが、excelだとセル幅がずれます。</p>
<form method="post" action="/students_export">
    @csrf
    <input type="submit" value="ダウンロード">
</form>
