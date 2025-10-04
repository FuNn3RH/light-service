  <div class="table-responsive">
      <table class="table table-bordered table-striped text-center align-middle">
          <thead class="table-dark">
              <tr>
                  <th>#</th>
                  <th>نام کاربری</th>
                  <th>نقش</th>
                  <th>زمان ایجاد</th>
                  <th>عملیات</th>
              </tr>
          </thead>
          <tbody>
              @forelse ($users as $user)
                  <livewire:hoosh.admin.users.users-row :$user :key="$user->id" />
              @empty
                  <tr>
                      <td colspan="5">
                          <h5 class="text-center my-3">کاربری وجود ندارد</h5>
                      </td>
                  </tr>
              @endforelse

          </tbody>
      </table>
  </div>
