<form method="post" action="/students_import" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" ><br>
    <input type="submit" value="インポート">
</form>
<table>
        <thead>
        <tr>
          <th>生徒ID</th>
          <th>生徒名</th>
          <th>学年</th>
          <th>数学</th>
          <th>国語</th>
          <th>英語</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
          <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->grade }}</td>
            <td>{{ $student->math }}</td>
            <td>{{ $student->japanese }}</td>
            <td>{{ $student->english }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
<form method="post" action="/students_export">
    @csrf
    <input type="submit" value="生徒データダウンロード">
</form>
