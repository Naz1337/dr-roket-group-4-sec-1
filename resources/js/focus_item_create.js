const task = document.getElementById('task');
task.focus()

const og_task = task.value
task.value = ''
task.value = og_task
