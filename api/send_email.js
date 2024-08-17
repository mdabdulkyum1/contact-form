const nodemailer = require('nodemailer');

export default async function handler(req, res) {
    if (req.method === 'POST') {
        const { name, email, message } = req.body;

        let transporter = nodemailer.createTransport({
            service: 'gmail', // Or any email service
            auth: {
                user: process.env.EMAIL, // Your email
                pass: process.env.PASSWORD, // Your email password
            },
        });

        let mailOptions = {
            from: email,
            to: process.env.EMAIL,
            subject: `Contact form submission from ${name}`,
            text: message,
        };

        try {
            await transporter.sendMail(mailOptions);
            res.status(200).json({ status: 'Message sent!' });
        } catch (error) {
            res.status(500).json({ status: 'Failed to send message', error });
        }
    } else {
        res.status(405).json({ status: 'Method not allowed' });
    }
}
