export default async function handler(req, res) {
    res.setHeader('Content-Type', 'text/plain');
    let output = "Testing Node.js Diagnostic Endpoint...\n";
    
    output += `Node Environment: ${process.version}\n`;
    output += `DB_HOST: ${process.env.DB_HOST || 'NOT SET'}\n`;
    output += `REDIS_HOST: ${process.env.REDIS_HOST || 'NOT SET'}\n\n`;

    output += "If you can see this, Vercel Serverless Functions are working correctly.\n";
    output += "If the PHP pages still return 500, the vercel-php builder is failing on your Vercel account.\n";
    
    res.status(200).send(output);
}
