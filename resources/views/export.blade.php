<table>
  <thead>
    <tr>
      <th style="font-size: 12px; font-weight: bold; color: #02AC; text-align: center;">N°</th>
      <th>Matricula</th>
      <th>Alumno</th>
      <th>Genero</th>
      <th>Fecha de Nacimiento</th>
      <th>E-mail</th>
    </tr>
  </thead>
  <tbody>
    @foreach($alumnos as $alumno)
    <tr>
      <td>{{ $alumno->id }}</td>
      <td>{{ $alumno->matricula }}</td>
      <td>{{ $alumno->app .', '. $alumno->nombre }}</td>
      <td>{{ $alumno->gen }}</td>
      <td>{{ $alumno->fn }}</td>
      <td><a href="mailto: {{ $alumno->email }}">{{ $alumno->email }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
