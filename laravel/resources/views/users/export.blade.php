<table>
  <thead>
  <tr>
    <th>{{ __('users.id') }}</th>
    <th>{{ __('company_types.name') }}</th>
    <th>{{ __('companies.name') }}</th>
    <th>{{ __('roles.name') }}</th>
    <th>{{ __('users.name') }}</th>
    <th>{{ __('users.email') }}</th>
    <th>{{ __('users.created_at') }}</th>
    <th>{{ __('users.updated_at') }}</th>
    <th>{{ __('users.created_by') }}</th>
    <th>{{ __('users.updated_by') }}</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr>
      <td>{{ $model->id }}</td>
      <td>{{ $model->company->companyType->name }}</td>
      <td>{{ $model->company->name }}</td>
      <td>{{ $model->role->name }}</td>
      <td>{{ $model->name }}</td>
      <td>{{ $model->email }}</td>
      <td>{{ $model->created_at }}</td>
      <td>{{ $model->updated_at }}</td>
      <td>{{ $model->createdBy->name }}</td>
      <td>{{ $model->updatedBy->name }}</td>
    </tr>
  @endforeach
  </tbody>
</table>