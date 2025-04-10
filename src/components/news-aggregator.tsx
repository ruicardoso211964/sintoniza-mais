import React from 'react';import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface NewsItem {
  title: string;
  description: string;
  source: string;
}

const mockNewsData: NewsItem[] = [
  {
    title: 'Notícia Local 1',
    description: 'Descrição breve da notícia local 1.',
    source: 'Rádio Local A',
  },
  {
    title: 'Notícia Local 2',
    description: 'Descrição breve da notícia local 2.',
    source: 'Rádio Local B',
  },
  {
    title: 'Notícia Local 3',
    description: 'Descrição breve da notícia local 3.',
    source: 'Rádio Local A',
  },
];

const NewsAggregator: React.FC = () => {
  return (
    <section className="container mx-auto mt-8">
      <div className="mb-6 px-4">
        <h2 className="text-3xl font-bold text-gray-800">Notícias Locais</h2>
      </div>
      <div className="grid grid-cols-1 gap-6 px-4 md:grid-cols-2 lg:grid-cols-3">
        {mockNewsData.map((news, index) => (
          <Card key={index} className="shadow-md">
            <CardHeader>
              <CardTitle className="text-lg font-semibold">{news.title}</CardTitle>
            </CardHeader>
            <CardContent>
              <CardDescription className="text-gray-700">{news.description}</CardDescription>
              <p className="text-gray-500 text-sm mt-2">Fonte: {news.source}</p>
            </CardContent>
          </Card>
        ))}
      </div>
    </section>
  );
};

export default NewsAggregator;