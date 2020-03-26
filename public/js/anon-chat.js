const createChat = async () => {
  await fetch('/chat/public/chat', {
    method: 'POST'
  });
};

const transferAnon = async data => {
  const response = await fetch('/chat/public/chat/transfer', {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  console.log(await response.json());
};
const anon_user_form = document.getElementById('form-anon');

if (anon_user_form) {
  anon_user_form.addEventListener('submit', async e => {
    e.preventDefault();
    await createChat();
    const anon_button = document.querySelector('#anon-button');
    anon_button.setAttribute('disabled', '');
  });
}

const transfer = document.querySelector('#transfer-anon');

if (transfer) {
  transfer.addEventListener('click', async e => {
    const anon_id = document.querySelector('#anon_id').value;
    const user_id = document.querySelector('#user_id').value;

    await transferAnon({ anon_id, user_id });
    transfer.setAttribute('disabled', '');
  });
}
