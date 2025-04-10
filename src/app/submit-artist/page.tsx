'use client';

import {Button} from '@/components/ui/button';
import {
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form';
import {Input} from '@/components/ui/input';
import {Label} from '@/components/ui/label';
import {Textarea} from '@/components/ui/textarea';
import {useToast} from '@/hooks/use-toast';
import {Artist} from '@/services/artist';
import {submitArtist} from '@/services/artist';
import {useRouter} from 'next/navigation';
import {useForm} from 'react-hook-form';
import {z} from 'zod';
import {zodResolver} from '@hookform/resolvers/zod';
import {useState} from 'react';
import {generateArtistDescription} from '@/ai/flows/generate-artist-description';
import { useEffect } from 'react';
import { cn } from '@/lib/utils';

const artistFormSchema = z.object({
  artistName: z.string().min(2, {
    message: 'Artist name must be at least 2 characters.',
  }),
  musicGenres: z.string().min(2, {
    message: 'Music genres must be at least 2 characters.',
  }),
  artistBio: z.string().min(10, {
    message: 'Artist bio must be at least 10 characters.',
  }),
  inspiration: z.string().optional(),
});

type ArtistFormValues = z.infer<typeof artistFormSchema>;

export default function SubmitArtistPage() {
  const [isDescriptionGenerating, setIsDescriptionGenerating] = useState(false);
  const [generatedDescription, setGeneratedDescription] = useState<string | null>(null);
  const router = useRouter();
  const {toast} = useToast();

  // 1. Define your form.
  const form = useForm<ArtistFormValues>({
    resolver: zodResolver(artistFormSchema),
    defaultValues: {
      artistName: '',
      musicGenres: '',
      artistBio: '',
      inspiration: '',
    },
  });

  useEffect(() => {
    if (generatedDescription) {
      form.setValue('artistBio', generatedDescription);
    }
  }, [generatedDescription, form]);

  // 2. Define a submit handler.
  async function onSubmit(values: ArtistFormValues) {
    setIsDescriptionGenerating(true);
    try {
      const result = await generateArtistDescription({
        artistName: values.artistName,
        musicGenres: values.musicGenres.split(',').map(s => s.trim()),
        artistBio: values.artistBio,
        inspiration: values.inspiration,
      });
      setGeneratedDescription(result.artistDescription);
      toast({
        title: 'Artist description generated!',
        description: 'AI-generated description has been added to the Artist Bio.',
      });
    } catch (error: any) {
      console.error('Error generating artist description:', error);
      toast({
        variant: 'destructive',
        title: 'Failed to generate description.',
        description: error.message,
      });
    } finally {
      setIsDescriptionGenerating(false);
    }
  }

  async function handleFormSubmit(values: ArtistFormValues) {
    try {
      const artist: Artist = {
        id: crypto.randomUUID(),
        name: values.artistName,
        bio: values.artistBio,
        musicSamples: [], // Add music samples later
        contactInfo: '', // Add contact info later
        genres: values.musicGenres.split(',').map(s => s.trim()),
      };

      await submitArtist(artist);
      toast({
        title: 'Artist submitted!',
        description: 'Your artist profile has been submitted.',
      });
      router.refresh();
    } catch (error: any) {
      toast({
        variant: 'destructive',
        title: 'Failed to submit artist.',
        description: error.message,
      });
    }
  }

  return (
    <div className="container max-w-2xl mx-auto mt-8 p-4 bg-secondary rounded-lg shadow-md">
      <h1 className="text-2xl font-bold mb-4">Submit Artist Profile</h1>
      <Form {...form}>
        <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-4">
          <FormField
            control={form.control}
            name="artistName"
            render={({field}) => (
              <FormItem>
                <FormLabel>Artist Name</FormLabel>
                <FormControl>
                  <Input placeholder="Enter artist name" {...field} />
                </FormControl>
                <FormDescription>This is the name of the artist.</FormDescription>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="musicGenres"
            render={({field}) => (
              <FormItem>
                <FormLabel>Music Genres</FormLabel>
                <FormControl>
                  <Input placeholder="Enter music genres (comma-separated)" {...field} />
                </FormControl>
                <FormDescription>Enter the genres of music the artist plays, separated by commas.</FormDescription>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="artistBio"
            render={({field}) => (
              <FormItem>
                <FormLabel>Artist Bio</FormLabel>
                <FormControl>
                  <Textarea placeholder="Write a brief biography of the artist" {...field} className={cn(isDescriptionGenerating ? "cursor-not-allowed opacity-50" : "")} disabled={isDescriptionGenerating} />
                </FormControl>
                <FormDescription>Write a brief biography of the artist.</FormDescription>
                <FormMessage />
              </FormItem>
            )}
          />
          <FormField
            control={form.control}
            name="inspiration"
            render={({field}) => (
              <FormItem>
                <FormLabel>Inspiration (Optional)</FormLabel>
                <FormControl>
                  <Input placeholder="Enter artist inspirations" {...field} />
                </FormControl>
                <FormDescription>Optional: Inspirations of the artist.</FormDescription>
                <FormMessage />
              </FormItem>
            )}
          />
          <Button type="submit" disabled={isDescriptionGenerating}>
            {isDescriptionGenerating ? 'Generating...' : 'Generate AI Description'}
          </Button>
        </form>
      </Form>
      {form.formState.isSubmitSuccessful && (
        <form onSubmit={form.handleSubmit(handleFormSubmit)} className="mt-4">
          <Button type="submit">Submit Artist Profile</Button>
        </form>
      )}
    </div>
  );
}
