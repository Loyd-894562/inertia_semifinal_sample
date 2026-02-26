<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { computed, ref } from 'vue'
import { usePage, Link, router } from '@inertiajs/vue3'


const page = usePage()

// Simple client-side search
const q = ref('')

const students = computed(() => page.props.students ?? [])

const filteredStudents = computed(() => {
  const query = q.value.trim().toLowerCase()
  if (!query) return students.value

  return students.value.filter((s) => {
    const fullName = `${s.first_name} ${s.last_name}`.toLowerCase()
    return (
      String(s.student_no).toLowerCase().includes(query) ||
      fullName.includes(query) ||
      String(s.email).toLowerCase().includes(query)
    )
  })
})

const destroyStudent = (id) => {
  if (!confirm('Delete this student?')) return

  router.delete(route('students.destroy', id), {
    preserveScroll: true,
  })
}
</script>

<template>
  <AuthenticatedLayout>
  <div class="min-h-screen bg-gradient-to-b from-slate-50 to-white">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <div class="inline-flex items-center gap-2">
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm">
              🎓
            </span>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">Student Records</h1>
          </div>
          <p class="mt-2 text-sm text-slate-600">
            Manage your students list and keep records up to date.
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
          <!-- Search -->
          <div class="relative">
            <input
              v-model="q"
              type="text"
              placeholder="Search by name, email, or student no…"
              class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 pr-10 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 sm:w-80"
            />
            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">⌕</span>
          </div>

          <!-- Add -->
          <Link
            :href="route('students.create')"
            class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
          >
            + Add Student
          </Link>
        </div>
      </div>

      <!-- Flash -->
      <div
        v-if="page.props.flash?.success"
        class="mt-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900 shadow-sm"
      >
        <span class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-emerald-600 text-white">
          ✓
        </span>
        <div class="text-sm font-medium">
          {{ page.props.flash.success }}
        </div>
      </div>

      <!-- Card -->
      <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <!-- Top bar -->
        <div class="flex flex-col gap-2 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <div class="text-sm font-semibold text-slate-900">Students</div>
            <div class="mt-1 text-xs text-slate-500">
              Showing <span class="font-medium text-slate-700">{{ filteredStudents.length }}</span>
              of <span class="font-medium text-slate-700">{{ students.length }}</span>
            </div>
          </div>

          <div class="text-xs text-slate-500">
            Tip: keep student emails unique to avoid duplicates.
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-slate-50">
              <tr class="text-left">
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-600">Student No</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-600">Student</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-600">Email</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wide text-slate-600">Actions</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 bg-white">
              <tr v-for="student in filteredStudents" :key="student.id" class="transition hover:bg-slate-50">
                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                  {{ student.student_no }}
                </td>

                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div
                      class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-700"
                      title="Student"
                    >
                      {{ (student.first_name?.[0] ?? 'S') + (student.last_name?.[0] ?? '') }}
                    </div>
                    <div>
                      <div class="text-sm font-semibold text-slate-900">
                        {{ student.first_name }} {{ student.last_name }}
                      </div>
                      <div class="text-xs text-slate-500">ID: {{ student.id }}</div>
                    </div>
                  </div>
                </td>

                <td class="px-6 py-4 text-sm text-slate-700">
                  <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                    {{ student.email }}
                  </span>
                </td>

                <td class="px-6 py-4">
          
                    <!-- Your edit and delete buttons -->
                </td>
              </tr>

              <!-- Empty state -->
              <tr v-if="filteredStudents.length === 0">
                <td colspan="4" class="px-6 py-14 text-center">
                  <div class="mx-auto max-w-sm">
                    <div class="text-base font-semibold text-slate-900">No results</div>
                    <div class="mt-1 text-sm text-slate-600">
                      Try a different search, or add a new student.
                    </div>
                    <div class="mt-4 flex items-center justify-center gap-2">
                      <button
                        type="button"
                        @click="q = ''"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
                      >
                        Clear search
                      </button>

                      <Link
                        :href="route('students.create')"
                        class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-700"
                      >
                        + Add Student
                      </Link>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </AuthenticatedLayout>
</template>
