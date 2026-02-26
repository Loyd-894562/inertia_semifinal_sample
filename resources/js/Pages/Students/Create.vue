<script setup>
import { useForm, Link } from '@inertiajs/vue3'


const form = useForm({
  student_no: '',
  first_name: '',
  last_name: '',
  email: '',
  // birthdate: '',
})

const submit = () => {
  form.post(route('students.store'), {
    preserveScroll: true,
  })
}
</script>

<template>
  <div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="flex items-start justify-between gap-4">
        <div>
          <h2 class="text-2xl font-semibold text-slate-900">Create Student</h2>
          <p class="mt-1 text-sm text-slate-600">Fill out the form to add a new student record.</p>
        </div>

        <Link
          :href="route('students.index')"
          class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
        >
          ← Back
        </Link>
      </div>

      <!-- Form Card -->
      <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form @submit.prevent="submit" class="space-y-5">
          <!-- Student Number -->
          <div>
            <label for="student_no" class="block text-sm font-medium text-slate-700">
              Student Number
            </label>
            <input
              id="student_no"
              v-model="form.student_no"
              type="text"
              class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
              placeholder="e.g., 2026-0001"
              autocomplete="off"
            />
            <p v-if="form.errors.student_no" class="mt-2 text-sm text-red-600">
              {{ form.errors.student_no }}
            </p>
          </div>

          <!-- First + Last Name -->
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label for="first_name" class="block text-sm font-medium text-slate-700">
                First name
              </label>
              <input
                id="first_name"
                v-model="form.first_name"
                type="text"
                class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                placeholder="Juan"
                autocomplete="off"
              />
              <p v-if="form.errors.first_name" class="mt-2 text-sm text-red-600">
                {{ form.errors.first_name }}
              </p>
            </div>

            <div>
              <label for="last_name" class="block text-sm font-medium text-slate-700">
                Last name
              </label>
              <input
                id="last_name"
                v-model="form.last_name"
                type="text"
                class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                placeholder="Dela Cruz"
                autocomplete="off"
              />
              <p v-if="form.errors.last_name" class="mt-2 text-sm text-red-600">
                {{ form.errors.last_name }}
              </p>
            </div>
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-slate-700">
              Email
            </label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
              placeholder="student@example.com"
              autocomplete="off"
            />
            <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">
              {{ form.errors.email }}
            </p>
          </div>

          <!-- Birthdate
          <div>
            <label for="birthdate" class="block text-sm font-medium text-slate-700">
              Birthdate
            </label>
            <input
              id="birthdate"
              v-model="form.birthdate"
              type="date"
              class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
            />
            <p v-if="form.errors.birthdate" class="mt-2 text-sm text-red-600">
              {{ form.errors.birthdate }}
            </p>
          </div> -->

          <!-- Actions -->
          <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-60"
            >
              {{ form.processing ? 'Saving…' : 'Save Student' }}
            </button>

            <button
              type="button"
              @click="form.reset()"
              class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
              Reset
            </button>

            <p v-if="form.processing" class="text-xs text-slate-500 sm:ml-auto">
              Please wait, saving your changes…
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
